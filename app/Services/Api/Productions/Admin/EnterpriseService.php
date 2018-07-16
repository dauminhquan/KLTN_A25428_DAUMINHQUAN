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
        foreach ($array as $item)
        {
            $enterprise = Enterprise::find($item);
            if($enterprise)
            {
                if(Storage::exists($enterprise->avatar))
                {
                    Storage::delete($enterprise->avatar);
                }
                $enterprise->delete();
            }
        }
        return $array;
    }

    public function excelStore($array){
        $list_err = [];

        $data = Excel::load($array,function($reader){
            $reader->all();

        })->get();
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                // check xem ma nganh
                // ma khoa co ton tai khong


                if(
                    $item->name_enterprise == null ||
                    $item->address_enterprise == null ||
                    $item->name_president_enterprise == null ||
                    $item->phone_number_enterprise == null ||
                    $item->password == null ||
                    $item->email_address_enterprise == null||
                    $this->existEmailEnterprise($item->email_address_enterprise))
                {

                    $list_err[] = [
                        'item' => $item->email_address_enterprise,
                        'message' => 'Thiếu thông tin | Thông tin bị trùng | Không đúng form'
                    ];
                }
                else{
                    $user = new User();
                    $user->user_name = $item->email_address_enterprise;
                    $user->password = Hash::make($item->password);
                    $user->authentication = true;
                    $user->type = 2;
                    $user->save();
                    $enterprise = new Enterprise();
                    $enterprise->name_enterprise = $item->name_enterprise;
                    $enterprise->address_enterprise = $item->address_enterprise;
                    $enterprise->name_president_enterprise = $item->name_president_enterprise;
                    $enterprise->phone_number_enterprise = $item->phone_number_enterprise;

                    $enterprise->avatar_enterprise = $item->avatar_enterprise;

                    $enterprise->id_user = $user->id;

                    $enterprise->save();
                }


            }
        }
        if(count($list_err) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ"
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
}