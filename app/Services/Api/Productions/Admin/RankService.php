<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Rank;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class RankService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Rank();
    }
    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                return Rank::paginate(100000);
            }
            return Rank::paginate($inputs['size']);
        }
        return Rank::paginate(500);

    }

    public function getOne($id)
    {
        $rank = Rank::findOrFail($id);
        return $rank;
    }

    public function getProfile($option)
    {
        return Rank::select($option)->get();
    }

    public function save($inputs)
    {
        $rank = Rank::create($inputs->all());

        return $rank;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Rank())->getTable());
            $rank = Rank::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $rank->$column = $inputs[$column];
                }

            }
            $rank->update();
            return $rank;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $rank = Rank::findOrFail($id);
        $rank->delete();
        return $rank;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $rank = Rank::find($item);
            if($rank)
            {
                $rank->delete();
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
                    Rank::create($item);
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