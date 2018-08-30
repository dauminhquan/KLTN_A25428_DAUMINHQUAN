<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Branch;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class BranchService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Branch();
    }

    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                $branches = Branch::paginate(100000);
            }
            else{
                $branches = Branch::paginate($inputs['size']);
            }
        }else{
            $branches = Branch::paginate(500);
        }
       foreach ($branches as $branch)
       {
           $branch->department = $branch->department;
       }
        return $branches;
    }

    public function getOne($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->department = $branch->department;
        return $branch;
    }

    public function getProfile($option)
    {
        return Branch::select($option)->get();
    }

    public function save($inputs)
    {
        $branch = Branch::create($inputs->all());

        return $branch;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Branch())->getTable());
            $branch = Branch::findOrFail($id);
            foreach ($columns as $column)
            {
                if(array_key_exists($column,$inputs))
                {
                    $branch->$column = $inputs[$column];
                }

            }
            $branch->update();
            return $branch;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return $branch;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $branch = Branch::find($item);
            if($branch)
            {
                $branch->delete();
                unset($success[$item]);
            }

        }
        return $array;
    }

    public function csvStore($path){
        $list_err = [];

        $data = Excel::load($path,function($reader){})->get()->toArray();
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                try{
                    Branch::create($item);
                }catch (\Exception $exception)
                {
                    $list_err[] = [
                        'error' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ];
                }
            }
        }
        if(count($list_err) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ",
                'error' => $list_err
            ],422);
        }
        return [
            'message' => 'Thành công',
            'error' => $list_err
        ];
    }

}