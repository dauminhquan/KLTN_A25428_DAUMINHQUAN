<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 1:37 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Student;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Student();
    }

    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                return Student::paginate(100000);
            }
            return Student::paginate($inputs['size']);
        }
        return Student::paginate(500);
    }

    public function getOne($id)
    {
        $student = Student::findOrFail($id);
        $department = $student->branch->department;
        return response()->json([
            'student' => $student,
            'department' => $department
        ]);
    }

    public function getProfile($option)
    {
        return Student::select($option);
    }

    public function save($inputs){
        try{
            $student = Student::create($inputs);
            return $student;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function update($inputs,$id)
    {

            try{
                $columns = Schema::getColumnListing((new Student())->getTable());
                $student = Student::findOrFail($id);
                foreach ($columns as $column)
                {
                    if(isset($inputs[$column]))
                    {
                        $student->$column = $inputs[$column];
                    }
                }
                $student->update();
                return $student;
            }catch (\Exception $exception)
            {
                return ['err' => $exception->getMessage()];
            }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if(Storage::exists($student->avatar) && $student->avatar != env('AVATAR_DEFAULT'))
        {
            Storage::delete($student->avatar);
        }
        $student->works()->delete();
        $student->user()->delete();
        $student->delete();
        return $student;
    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $key => $item)
        {
            $student = Student::find($item);
            if($student)
            {
                if(Storage::exists($student->avatar) && $student->avatar != env('AVATAR_DEFAULT'))
                {
                    Storage::delete($student->avatar);
                }
                $student->works()->delete();
                $student->user()->delete();
                $student->delete();
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
                    Student::create($item);
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
        $student = Student::findOrFail($id);
        if(Storage::exists($student->avatar) && $student->avatar != env('AVATAR_DEFAULT'))
        {
            Storage::delete($student->avatar);
        }
        $url = $avatar->store('/public/avatar');
        $student->avatar = $url;
        $student->update();
        return [
            'url' => $url
        ];
    }

    public function getListEnterprise($id)
    {
        $student = Student::findOrFail($id);
        return $student->enterprises;
    }

    public function getListJob($id){
        $student = Student::findOrFail($id);
        return $student->jobs;
    }
    public function getUser($id)
    {
        $student = Student::findOrFail($id);

        return $student->user;
    }
}