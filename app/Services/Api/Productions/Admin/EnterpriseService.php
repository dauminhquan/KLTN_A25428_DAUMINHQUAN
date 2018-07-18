<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 1:37 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Enterprise;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EnterpriseService implements ManageInterface
{


    public function getAll()
    {
        return Enterprise::all();
    }

    public function getOne($id)
    {
        return Enterprise::findOrFail($id);
    }

    public function getProfile($option)
    {
        return Enterprise::select($option);
    }

    public function save($inputs){
        try{
            $enterprise = Enterprise::create($inputs);
            return $enterprise;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function update($inputs,$id)
    {

            try{
                $columns = Schema::getColumnListing((new Enterprise())->getTableName());
                $enterprise = Enterprise::findOrFail($id);
                foreach ($columns as $column)
                {
                    if(isset($inputs[$column]))
                    {
                        $enterprise->$column = $inputs[$column];
                    }

                }
                $enterprise->update();
                return $enterprise;
            }catch (\Exception $exception)
            {
                return ['err' => $exception->getMessage()];
            }
    }
    public function destroy($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        if(Storage::exists($enterprise->avatar))
        {
            Storage::delete($enterprise->avatar);
        }
        $enterprise->delete();
        return $enterprise;
    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $key => $item)
        {
            $enterprise = Enterprise::find($item);
            if($enterprise)
            {
                if(Storage::exists($enterprise->avatar))
                {
                    Storage::delete($enterprise->avatar);
                }
                $enterprise->delete();
                unset($success[$key]);
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
                    Enterprise::create($item);
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
            ],406);
        }
        return [
            'message' => 'Thêm danh sách doanh nghiệp thành công',
            'error' => $list_err
        ];
    }

    public function updateAvatar($id,$avatar){
        $enterprise = Enterprise::findOrFail($id);
        if(Storage::exists($enterprise->avatar))
        {
            Storage::delete($enterprise->avatar);
        }
        $url = $avatar->store('/public/avatar');
        $enterprise->avatar = $url;
        $enterprise->update();
        return [
            'url' => $url
        ];
    }
    public function getListStudent($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        return $enterprise->students;
    }
    public function getListJob($id){
        $enterprise = Enterprise::findOrFail($id);
        return $enterprise->jobs;
    }
}