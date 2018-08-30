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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

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
        $errors = [];
        $user = new User();
        $columns = Schema::getColumnListing((new User())->getTable());
        foreach ($columns as $column)
        {
            if(array_key_exists($column,$inputs))
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
               $admin = Admin::find($inputs['per']);
               if($admin)
               {
                   $admin->user_id = $user->id;
                   $admin->update();
                   return $user;
               }
               $errors['admin'] = [
                    'Admin tồn tại'
               ];

           }
           if($inputs['type'] == 2)
           {
               $enterprise = Enterprise::find($inputs['per']);
               if($enterprise)
               {
                   $enterprise->user_id = $user->id;
                   $enterprise->update();
                   return $user;
               }
               $errors['enterprise'] = [
                   'Doanh nghiệp không tồn tại'
               ];
           }
           if($inputs['type'] == 3)
           {
               $student = Student::find($inputs['per']);
               if($student)
               {
                   $student->user_id = $user->id;
                   $student->update();
                   return $user;
               }
               $errors['student'] = [
                   'Sinh viên không tồn tại'
               ];
           }
       }
        $user->delete();
       return response()->json([
           'message' => 'Đã có lỗi xảy ra',
           'errors' => $errors
       ],422);

    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new User())->getTable());

            $user = User::findOrFail($id);
            foreach ($columns as $column)
            {
                if(array_key_exists($column,$inputs))
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

        $data = Excel::load($path,function($reader){})->get()->toArray();

        $listIndexError = [];
        $lengthSuccess = 0;
        if(count($data) > 0)
        {
            foreach ($data as $index => $item)
            {

                try{
                    $validator = Validator::make($item,[
                       'email' => 'email',
                        'type' => Rule::in([1,2,3])
                    ]);
                    if($validator->fails())
                    {
                        $listIndexError[] = [
                            'row' => $index+1,
                            'message' => $validator->errors()
                        ];
                        continue;
                    }
                    $admin_id = $item['admin_id'];
                    $student_code = $item['student_code'];
                    $enterprise_id = $item['enterprise_id'];
                    if(User::where('email',$item['email'])->first())
                    {
                        $listIndexError[] = [
                            'row' => $index+1,
                            'message' => 'Email đã tồn tại'
                        ];
                        continue;
                    }
                    unset($item['admin_id']);
                    unset($item['student_code']);
                    unset($item['enterprise_id']);
                    $item['password'] = Hash::make($item['password']);
                    $user = User::create($item);

                    if($item['type'] == 1)
                    {

                        $admin = Admin::find($admin_id);
                        if($admin)
                        {
                            if($admin->user_id != null)
                            {
                                $user->delete();
                                $listIndexError[] = [
                                    'row' => $index+1,
                                    'message' => 'Người dùng này đã có tài khoản rồi'
                                ];
                            }
                            else{
                                $admin->user_id = $user->id;
                                $admin->update();
                                $lengthSuccess++;
                            }
                        }
                        else{
                            $user->delete();
                            $listIndexError[] = [
                                'row' => $index+1,
                                'message' => 'Admin không tồn tại'
                            ];
                        }

                    }
                    elseif($item['type'] == 2)
                    {
                        $enterprise = Enterprise::find($enterprise_id);
                        if($enterprise)
                        {
                            if($enterprise->user_id != null)
                            {
                                $user->delete();
                                $listIndexError[] = [
                                    'row' => $index+1,
                                    'message' => 'Người dùng này đã có tài khoản rồi'
                                ];
                            }
                            else{
                                $enterprise->user_id = $user->id;
                                $enterprise->update();
                                $lengthSuccess++;
                            }
                        }
                        else{
                            $user->delete();
                            $listIndexError[] = [
                                'row' => $index+1,
                                'message' => 'Doanh nghiệp không tồn tại'
                            ];
                        }
                    }
                    elseif($item['type'] == 3)
                    {
                        $student = Student::find($student_code);
                        if($student)
                        {

                            if($student->user_id != null)
                            {
                                $user->delete();
                                $listIndexError[] = [
                                    'row' => $index+1,
                                    'message' => 'Người dùng này đã có tài khoản rồi'
                                ];
                            }
                            else{
                                $student->user_id = $user->id;
                                $student->update();
                                $lengthSuccess++;
                            }
                        }
                        else{
                            $user->delete();
                            $listIndexError[] = [
                                'row' => $index+1,
                                'message' => 'Sinh viên không tồn tại'
                            ];
                        }
                    }

                }catch (\Exception $exception)
                {
                    return response()->json([
                        'error' => 'Lỗi nghiêm trọng! Định dạng file không đúng, vui lòng kiểm tra lại',
                        'error_code' => $exception->getMessage()
                    ],405);
                }
            }
        }
        if($lengthSuccess == 0)
        {
            return response()->json([
                'message' => "Toàn bộ file không thể thêm vào. Vui lòng kiểm tra lại",
                'listError' => $listIndexError
            ],422);
        }
        return [
            'message' => 'Thành công',
            'error' => $listIndexError,
            'lengthSucess' => $lengthSuccess
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
