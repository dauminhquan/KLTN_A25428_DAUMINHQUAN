<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 1:37 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Notification;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class NotificationService implements ManageInterface
{


    public function getAll()
    {
        return Notification::all();
    }

    public function getOne($id)
    {
        return Notification::findOrFail($id);
    }

    public function getProfile($option)
    {
        return Notification::select($option);
    }

    public function save($inputs){
        try{
            $notification = Notification::create($inputs);
            return $notification;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function update($inputs,$id)
    {

            try{
                $columns = Schema::getColumnListing((new Notification())->getTableName());
                $notification = Notification::findOrFail($id);
                foreach ($columns as $column)
                {
                    if(isset($inputs[$column]))
                    {
                        $notification->$column = $inputs[$column];
                    }

                }
                $notification->update();
                return $notification;
            }catch (\Exception $exception)
            {
                return ['err' => $exception->getMessage()];
            }
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        $notification->delete();
        if(Storage::exists($notification->attachment))
        {
            Storage::delete($notification->attachment);
        }
        return $notification;
    }

    public function delete($array)
    {
        foreach ($array as $item)
        {
            $notification = Notification::find($item);
            if($notification)
            {
                if(Storage::exists($notification->attachment))
                {
                    Storage::delete($notification->attachment);
                }
                $notification->delete();
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
                    Notification::create($item);
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
}