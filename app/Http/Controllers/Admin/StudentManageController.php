<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StudentManageController extends Controller
{
    //
    public function studentManage()
    {
        return view('admin.studentmanage.studentmanage');
    }
    public function addStudent()
    {
        return view('admin.studentmanage.add_student');
    }
    public function infoStudent(Request $request)
    {
        if($request->has('code_student') && User::where('user_name',$request->code_student)->count()>0)
        {

            $code_student = $request->code_student;
            return view('admin.studentmanage.info_student',['code_student' => $code_student]);
        }

    }
    public function get_excel_info_student(){
        $info_student = Student::join('users',"users.id","students.id_user")->select('students.*',DB::raw('users.user_name as code_student'))->get();
        return response()->download(Excel::create('student-excel', function($excel) use($info_student) {
            $excel->sheet('student', function($sheet) use($info_student) {
                $sheet->fromArray($info_student);
            });
        })->export('xls'));
    }
    public function get_excel_example_info_student(){


        return response()->download(Excel::create('example-student-excel', function($excel) {
            $excel->sheet('student', function($sheet) {
                $sheet->fromArray([
                    'first_name_student',
                    'last_name_student',
                    'address_student',
                    'phone_number_student',
                    'email_address_student',
                    'introduce_student',
                    'avatar_student',
                    'graduated',
                    'code_branch',
                    'code_course',
                    'code_student',
                    'password'
                ]);
            });
        })->export('xls'));
    }
    public function get_excel_example_work_student(){
        return response()->download(Excel::create('work-example-student-excel', function($excel) {
            $excel->sheet('work', function($sheet) {
                $sheet->fromArray([
                    'email_address_enterprise',
                    'code_student',
                    'started_at',
                    'propped_at',
                    'id_salary',
                    'position',
                ]);
            });
        })->export('xls'));
    }
}
