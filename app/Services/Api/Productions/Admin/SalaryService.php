<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Salary;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class SalaryService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Salary();
    }
    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                return Salary::paginate(100000);
            }
            return Salary::paginate($inputs['size']);
        }
        return Salary::paginate(500);
    }

    public function getOne($id)
    {
        $salary = Salary::findOrFail($id);
        return $salary;
    }

    public function getProfile($option)
    {
        return Salary::select($option)->get();
    }

    public function save($inputs)
    {
        $salary = Salary::create($inputs->all());

        return $salary;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Salary())->getTableName());
            $salary = Salary::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $salary->$column = $inputs[$column];
                }

            }
            $salary->update();
            return $salary;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->jobs()->dissociate();
        $salary->delete();
        return $salary;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $salary = Salary::find($item);
            if($salary)
            {
                $salary->jobs()->dissociate();
                $salary->delete();
                unset($success[$item]);
            }

        }
        return $success;
    }

    public function csvStore($path){
        $list_err = [];

        $data = Excel::load($path,function($reader){})->get()->toArray();
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                try{
                    Salary::create($item);
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