<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:59
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Services\GetDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestInfoController extends Controller
{
    public function get_courses()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getCourses();
    }
    public function get_departments()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getDepartments();
    }
    public function get_branches_with_code_departments($code_departments)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getBranchesWithCodeDepartments($code_departments);
    }
    public function check_exist_info_student(Request $request)
    {
        $message = [];
        if($request->has('code_student'))
        {
            if($request->has('email_address_student'))
            {
                $user = User::where(DB::raw('user_name'),strtolower($request->code_student))->first();
                if($user != null)
                {
                    if(Student::where(DB::raw('LOWER(email_address_student)'),strtolower($request->email_address_student))->where('id_user','!=',$user->id)->count()>0)
                    {
                        $message[] = [
                            'email_address_student' => 1
                        ];
                    }
                    else{
                        $message[] = [
                            'email_address_student' => 0
                        ];
                    }
                }
            }
            elseif(User::where(DB::raw('LOWER(user_name)'),strtolower($request->code_student))->count()>0)
            {
                $message[] = [
                    'code_student' => 1
                ];
            }
            else{
                $message[] = [
                    'code_student' => 0
                ];
            }
        }
        elseif($request->has('email_address_student'))
        {
            if(Student::where(DB::raw('LOWER(email_address_student)'),strtolower($request->email_address_student))->count()>0)
            {
                $message[] = [
                    'email_address_student' => 1
                ];
            }
            else{
                $message[] = [
                    'email_address_student' => 0
                ];
            }
        }
        return $message;
    }
    public function get_option_student(Request $request)
    {
        if($request->has('code_student') && $request->has('option'))
        {
            $get_data_service = new GetDataService();
            return $get_data_service->getOptionStudent($request->code_student,$request->option);
        }
    }



    public function get_student_with_code_student(Request $request)
    {
            if($request->has('code_student'))
            {
                $get_data_service = new GetDataService();
                return $get_data_service->getStudentWithCodeStudent($request->code_student);
            }
    }
    public function get_list_salary()
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getSalary();
    }
//


// enterprise


    public function get_option_enterprise(Request $request){

        if($request->has('email_address_enterprise') && $request->has('option'))
        {
            $get_data_service = new GetDataService();
            return $get_data_service->getOptionEnterprise($request->email_address_enterprise,$request->option);
        }
    }
    public function check_exist_info_enterprise(Request $request)
    {
        $message =[];
        if($request->has('email_address_enterprise'))
        {
            if($request->has('email_address_enterprise_check'))
            {
                if(User::where(DB::raw('LOWER(user_name)'),strtolower($request->email_address_enterprise_check))->where(DB::raw('LOWER(user_name)'),'!=',strtolower($request->email_address_enterprise))->count()>0)
                {
                    $message = [
                        'email_address_enterprise' => 1
                    ];
                }
                else{
                    $message = [
                        'email_address_enterprise' => 0
                    ];
                }
            }
            else{
                if(User::where(DB::raw('LOWER(user_name)'),'==',strtolower($request->email_address_enterprise))->count()>0)
                {
                    $message = [
                        'email_address_enterprise' => 1
                    ];
                }
                else{
                    $message = [
                        'email_address_enterprise' => 0
                    ];
                }
            }

        }
        return $message;
    }
    public function get_enterprise_with_email_address_enterprise(Request $request)
    {
        if($request->has('email_address_enterprise'))
        {
            $get_data_service = new GetDataService();
            return $get_data_service->getEnterpriseWithEmailAddressEnterprise($request->email_address_enterprise);
        }
    }
}