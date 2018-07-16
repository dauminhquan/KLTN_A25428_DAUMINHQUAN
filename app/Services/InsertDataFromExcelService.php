<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:24
 */

namespace App\Services;


use App\Http\Requests\ExcelFile;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Salary;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class InsertDataFromExcelService
{
    public function insertExcelStudents(ExcelFile $request)
    {
        $list_err = [];

        $data = Excel::load($request->ExcelFileUpload,function($reader){
            $reader->all();

        })->get();

        if(count($data) > 0)
        {
            foreach ($data as $item)
            {
                $student  = new Student();
                // check xem ma nganh
                // ma khoa co ton tai khong

                $code_course = $item->code_course;
                $code_branch = $item->code_branch;
                $code_student = $item->code_student;
                if($code_course == null || $code_branch == null || $code_student == null || $item->password == null ||
                    $item->first_name_student == null ||
                    $item->last_name_student == null ||
                    $item->address_student == null ||
                    $item->phone_number_student == null ||
                    $item->email_address_student == null ||
                    !$this->existBranch($code_branch) ||
                    !$this->existCourse($code_course) ||
                    $this->existCodeStudent($code_student) ||
                    $this->existEmailStudent($item->email_address_student))
                {

                    $list_err[] = [
                        'item' => $item->code_student,
                        'message' => 'Thiếu thông tin | Thông tin bị trùng | Không đúng form'
                    ];
                }
                else{
                    $user = new User();
                    $user->user_name = $item->code_student;
                    $user->password = Hash::make($item->password);
                    $user->authentication = true;
                    $user->type = 3;
                    $user->save();
                    $student = new Student();
                    $student->first_name_student = $item->first_name_student;
                    $student->last_name_student = $item->last_name_student;
                    $student->address_student = $item->address_student;
                    $student->phone_number_student = $item->phone_number_student;
                    $student->email_address_student = $item->email_address_student;
                    $student->introduce_student = $item->introduce_student;
                    $student->avatar_student = $item->avatar_student;
                    $student->code_course = $item->code_course;
                    $student->code_branch = $item->code_branch;

                    $student->id_user = $user->id;
                    $student->graduated = $item->graduated;
                    $student->save();
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
            'message' => 'Thêm sinh viên thành công',
            'error' => $list_err
        ];
    }
    public function insertExcelWorkStudents(ExcelFile $request)
    {
        // masv
        // email doanh nghiep
        // vi tri
        // luong
        // thoi gian bat dau
        // thoi gian ket thuc
        $list_err = [];
        $data = Excel::load($request->ExcelFileUpload,function($reader){
            $reader->all();

        })->get();
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                // check xem ma nganh
                // ma khoa co ton tai khong


                if(
                    !$this->existEmailEnterprise($item->email_address_enterprise))
                {

                    $list_err[] = [
                        'item' => $item->email_address_enterprise,
                        'message' => 'Email doanh nghiệp không đúng'
                    ];
                }elseif(!$this->existEmailEnterprise($item->code_student))
                {
                    $list_err[] = [
                        'item' => $item->code_student,
                        'message' => 'Mã sinh viên không đúng'
                    ];
                }elseif(!$this->existSalary($item->salary))
                {
                    $list_err[] = [
                        'item' => $item->salary,
                        'message' => 'Mã lương không đúng'
                    ];
                }
                elseif($item->position == null)
                {
                    $list_err[] = [
                        'item' => 'code_student: '.$item->code_student.', email_address_enterprise:'.$item->email_address_enterprise,
                        'message' => 'Vị trí không đúng'
                    ];
                }
                else{
                    $employee = new Employee();
                    $employee->user_enterprise = $item->email_address_enterprise;
                    $employee->code_student = $item->code_student;
                    $employee->started_at = $item->started_at;
                    $employee->dropped_at = $item->dropped_at;
                    $employee->id_salary = $item->id_salary;
                    $employee->position = $item->position;
                    $employee->save();
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

    public function insertExcelEnterprises(ExcelFile $request){
        $list_err = [];

        $data = Excel::load($request->ExcelFileUpload,function($reader){
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


    private function existCourse($code_course)
    {
        if(Course::where('code_course',$code_course)->count() > 0)
        {
            return true;
        }
        return false;
    }
    private function existBranch($code_branch)
    {
        if(Branch::where('code_branch',$code_branch)->count() > 0)
        {
            return true;
        }
        return false;
    }
    private function existCodeStudent($code_student)
    {
        if(User::where('user_name',$code_student)->count()>0)
        {
            return true;
        }
        return false;
    }
    private function existEmailStudent($email_address_student)
    {
        if(Student::where('email_address_student',$email_address_student)->count() > 0)
        {
            return true;
        }
        return false;
    }
    private function existSalary($id)
    {
        if($id != null)
        {
            if(Salary::find($id))
            {
                return true;
            }
            return false;
        }
        return true;
    }
    private function existEmailEnterprise($email_address_enterprise)
    {
        if(User::where('user_name',$email_address_enterprise)->count()>0)
        {
            return true;
        }
        return false;
    }
}