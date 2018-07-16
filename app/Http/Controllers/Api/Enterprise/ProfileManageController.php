<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Services\GetDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileManageController extends Controller
{
    //
    public function option_profile_enterprise(Request $request)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getOptionEnterprise(Auth::user()->user_name,$request->option);
    }
    public function info(){
        $get_data_service = new GetDataService();
        return $get_data_service->getEnterpriseWithEmailAddressEnterprise(Auth::user()->user_name);

    }
    public function employees(){
        $data = Auth::user()->employees()->get();

        $employees = [];

        foreach ($data as $item)
        {

            $userStudent = $item->userStudent;

            $code_student = $item->code_student;
            $time_start_work = $item->started_at;
            $time_end_work = $item->dropped_at;
            $position = $item->position;
            $first_name_student = $userStudent->student->first_name_student;
            $last_name_student = $userStudent->student->last_name_student;
            $branch = $userStudent->student->branch->name_branch;
            $avatar_student = $userStudent->student->avatar_student;

            $employees[] = [
                "code_student" => $code_student,
                "time_start" => $time_start_work,
                'time_end' => $time_end_work,
                'first_name_student' => $first_name_student,
                'last_name_student' => $last_name_student,
                'avatar_student' => $avatar_student,
                'branch' => $branch,
                'position' => $position
            ];
        }
        return $employees;
    }
}
