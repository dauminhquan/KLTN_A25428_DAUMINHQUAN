<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Province;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class ProvinceService implements ManageInterface
{
    public function getAll()
    {
        $provinces = Province::all();
        return $provinces;
    }

    public function getOne($id)
    {
        $province = Province::findOrFail($id);
        return $province;
    }

    public function getProfile($option)
    {
        return Province::select($option)->get();
    }

    public function save($inputs)
    {
        $province = Province::create($inputs->all());

        return $province;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Province())->getTableName());
            $province = Province::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $province->$column = $inputs[$column];
                }

            }
            $province->update();
            return $province;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $province = Province::findOrFail($id);
        $province->delete();
        return $province;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $province = Province::find($item);
            if($province)
            {
                $province->delete();
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
                    Province::create($item);
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