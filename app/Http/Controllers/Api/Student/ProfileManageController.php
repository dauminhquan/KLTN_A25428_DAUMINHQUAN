<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\User;
use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileManageController extends Controller
{
    public function option_profile_student(Request $request)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getOptionStudent(Auth::user()->user_name,$request->option);
    }
    public function info(){
        $get_data_service = new GetDataService();
        return $get_data_service->getStudentWithCodeStudent(Auth::user()->user_name);

    }

    public function works(){
        $work_student = Employee::where('code_student',Auth::user()->user_name)->get();
        $enter = [];
        foreach ($work_student as $item)
        {
            $id_employee = $item->id;
            $userEnterprise = $item->userEnterprise;
            $user_enterprise = $userEnterprise->user_name;
            $time_start_work = date('d/m/Y',strtotime($item->started_at));
            $time_end_work = date('d/m/Y',strtotime($item->dropped_at));
            if($item->id_salary != null)
            {
                $salary = $item->salary->about;
            }
            else{
                $salary = null;
            }
            $id_salary = $item->id_salary;
            $position = $item->position;
            $name_enterprise = $userEnterprise->enterprise->name_enterprise;
            $avatar_enterprise = $userEnterprise->enterprise->avatar_enterprise;
            $introduce_enterprise = $userEnterprise->enterprise->introduce_enterprise;
            $enter[] = [
                "user_enterprise" => $user_enterprise,
                "time_start" => $time_start_work,
                'time_end' => $time_end_work,
                'name_enterprise' => $name_enterprise,
                'avatar_enterprise' => $avatar_enterprise,
                'introduce_enterprise' => $introduce_enterprise,
                'position' => $position,
                'salary' => $salary,
                'id' => $id_employee,
                'id_salary' => $id_salary
            ];
        }
        return $enter;
    }
    public function get_list_enterprise()
    {
        return Enterprise::join('users',"users.id","enterprises.id_user")->select('enterprises.name_enterprise',DB::raw('users.user_name as user_enterprise'))->get();
    }
    public function add_work_excel(ExcelFile $request)
    {
        $insert_excel_service = new InsertDataFromExcelService();
        return ['ok' => 123];
        //        return $insert_excel_service->insertExcelWorkStudents($request);
    }
    public function add_work(Request $request)
    {
//        $insert_data_service = new InsertDataService();
//        return $insert_data_service->insertWorkStudent($request);

        $validate = Validator::make($request->all(),[
            'email_address_enterprise' => 'required|exists:users,user_name',
            'started_at' =>'required',
            'position' => 'required',

        ],[
            'email_address_enterprise.required' => 'Không có Email',
            'email_address_enterprise.exists' => 'Doanh nghiệp không tồn tại',
            'started_at.required' => 'Không có thời gian bắt đầu',
            'position.required' =>' Không có vị trí',

        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors(),406);
        }
        if(User::where('user_name',$request->email_address_enterprise)->first()->type != 2)
        {
            return response()->json(['message' => 'Doanh nghiệp không tồn tại'],404);
        }


        $employee = new Employee();
        $employee->user_enterprise = $request->email_address_enterprise;
        $employee->code_student = Auth::user()->user_name;
        $employee->started_at = $request->started_at;
        $employee->dropped_at = $request->dropped_at;
        $employee->id_salary = $request->id_salary;
        $employee->position = $request->position;
        $employee->save();
        return ['message' => 'Thanh cong'];
    }
    public function delete_work($id){
        $employee = Employee::findOrFail($id);

        if($employee->code_student != Auth::user()->user_name)
        {
            return response()->json(['message' => 'Bạn không đủ quyền'],406);
        }

        $delete_data_service = new DeleteDataService();
        return $delete_data_service->DeleteWorkStudent($id);
    }
    public function update_avatar(Request $request){
//        $update_data_service = new UpdateDataService();
//        return $update_data_service->UpdateAvatarStudent($request);
//
//
        $validation = Validator::make($request->all(),
            [

                'avatar' => 'required|file|image'
            ],[

                'avatar.required' => 'Không có avatar gửi lên',
                'avatar.file' => 'Avatar không phải là file',
                'avatar.image' => 'Yêu cầu phải là file image'
            ]);
        if($validation->fails())
        {
            return response()->json($validation->errors(),406);
        }

        $url = $request->file('avatar')->storeAs('/public/avatar',$request->code_student.'_'.'avatar.'.$request->file('avatar')->getClientOriginalExtension());
        $url = str_replace('public','/storage',$url);
        $student = User::where('user_name',Auth::user()->user_name)->first()->student;
        $student->avatar_student= $url;
        $student->update();
        return [
            'url' => $url
        ];

    }
    public function update_info(Request $request)
    {
        $user = User::where('user_name',Auth::user()->user_name)->first();
        $student = $user->student;

        $validate = Validator::make($request->all(),[
            'code_course' => 'required|exists:courses,code_course',
            'code_branch'=> 'required|exists:branches,code_branch',
            'first_name_student' =>'required',
            'last_name_student' => 'required',
            'address_student' =>'required',
            'phone_number_student' => 'required',
            'email_address_student' => 'required|email|unique:students,email_address_student,'.$student->id,
        ],[
            'code_course.required' => 'Khóa học không có',
            'code_course.exists' => 'Khóa học không tồn tại',
            'code_branch.required' => 'Ngành học không có',
            'code_branch.exists' => 'Ngành học không tồn tại',
            'first_name_student.required' => 'Không có họ',
            'last_name_student.required' =>' Không có tên',
            'address_student.required' => 'Không có địa chỉ',
            'phone_number_student.required' => 'Không có số điện thoại',
            'email_address_student.required' => 'Không có Email',
            'email_address_student.unique' => 'Email đã tồn tại',
            'email_address_student.email' => 'Không đúng định dạng Email',
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors());
        }
        // update

        if($request->has('password') && $request->password !='' && $request->rep_password != '')
        {
            $validate = Validator::make($request->all(),[

                'password' => 'required',
                'rep_password' => 'required|same:password'
            ],[
                'password.required' => 'Không có password',
                'rep_password.required' => 'Không có nhập lại password',
                'rep_password.same' => 'Nhập lại mật khẩu không đúng'
            ]);
            if($validate->fails())
            {
                return response()->json($validate->errors());
            }
            return DB::transaction(function () use ($student,$request,$user){
                $student->code_course = $request->code_course;
                $student->code_branch = $request->code_branch;
                $student->first_name_student = $request->first_name_student;
                $student->last_name_student = $request->last_name_student;
                $student->address_student = $request->address_student;
                $student->phone_number_student = $request->phone_number_student;
                $student->email_address_student = $request->email_address_student;

                if($request->has('graduated'))
                {
                    $student->graduated = $request->graduated;
                }
                if($request->has('introduce_student'))
                {
                    $student->introduce_student = $request->introduce_student;

                }
                $student->save();
                $user->password = Hash::make($request->password);
                return [
                    'message' => 'Thành công'
                ];
            });
        }
        else{
            $student->code_course = $request->code_course;
            $student->code_branch = $request->code_branch;
            $student->first_name_student = $request->first_name_student;
            $student->last_name_student = $request->last_name_student;
            $student->address_student = $request->address_student;
            $student->phone_number_student = $request->phone_number_student;
            $student->email_address_student = $request->email_address_student;

            if($request->has('graduated'))
            {
                $student->graduated = $request->graduated;
            }
            if($request->has('introduce_student'))
            {
                $student->introduce_student = $request->introduce_student;

            }
            $student->save();
            return [
                'message' => 'Thành công'
            ];
        }
    }
}
