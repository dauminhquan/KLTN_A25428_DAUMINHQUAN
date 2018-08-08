<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/19/2018
 * Time: 2:57 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Admin;
use App\Models\Enterprise;
use App\Models\Student;
use App\Models\User;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new User();
    }
    public function getAll($inputs)
    {
        $me = Auth::user();
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                $users = User::where('id','<>',$me->id)->paginate(100000);
            }
            else{
                $users = User::where('id','<>',$me->id)->paginate($inputs['size']);
            }
        }
        else {
            $users = User::where('id','<>',$me->id)->paginate(500);
        }
        foreach ($users as $user)
        {
            $user->student = $user->student;
            $user->enterprise = $user->enterprise;
            $user->admin = $user->admin;
        }
        return $users;

    }

    public function getOne($id)
    {
        $user = User::findOrFail($id);
        $user->student = $user->student;
        $user->enterprise = $user->enterprise;
        $user->admin = $user->admin;
        return $user;
    }

    public function getProfile($option)
    {
        return User::select($option)->get();

    }

    public function save($inputs)
    {

        $user = new User();
        $columns = Schema::getColumnListing((new User())->getTable());
        foreach ($columns as $column)
        {
            if(isset($inputs[$column]))
            {

                if($column == 'password')
                {
                    $user->$column = Hash::make($inputs[$column]);
                }
                else{
                    $user->$column = $inputs[$column];
                }

            }

        }
        $user->save();
       if(isset($inputs['per']))
       {
           if($inputs['type'] == 1)
           {
               $admin = Admin::findOrFail($inputs['per']);
               $admin->user_id = $user->id;
               $admin->update();
           }
           if($inputs['type'] == 2)
           {
               $enterprise = Enterprise::findOrFail($inputs['per']);
               $enterprise->user_id = $user->id;
               $enterprise->update();
           }
           if($inputs['type'] == 3)
           {
               $student = Student::findOrFail($inputs['per']);
               $student->user_id = $user->id;
               $student->update();
           }
       }
        return $user;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new User())->getTable());

            $user = User::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {

                    if($column == 'password')
                    {
                        $user->$column = Hash::make($inputs[$column]);
                    }
                    else{
                        $user->$column = $inputs[$column];
                    }

                }

            }
            $user->update();
            return $user;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->student != null)
        {
            $user->student->user_id = null;
            $user->student->update();
        }
        if($user->enterprise != null)
        {
            $user->enterprise->user_id = null;
            $user->enterprise->update();
        }
        if($user->admin != null)
        {
            $user->admin->user_id = null;
            $user->admin->update();
        }
        $user->delete();
        return $user;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $user = User::find($item);
            if($user)
            {
                if($user->student != null)
                {
                    $user->student->user_id = null;
                    $user->student->update();
                }
                if($user->enterprise != null)
                {
                    $user->enterprise->user_id = null;
                    $user->enterprise->update();
                }
                if($user->admin != null)
                {
                    $user->admin->user_id = null;
                    $user->admin->update();
                }
                $user->delete();
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
                    User::create($item);
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

    public function getEnterprise($id){
        $user = User::findOrFail($id);
        return $user->enterprise;
    }
    public function getStudent($id){
        $user = User::findOrFail($id);
        return $user->student;
    }
    public function getAdmin($id){
        $user = User::findOrFail($id);
        return $user->admin;
    }
}