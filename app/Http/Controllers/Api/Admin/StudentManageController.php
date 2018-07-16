<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\ExcelFile;

use App\Models\Enterprise;
use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class StudentManageController extends Controller
{
    //
    public function add_student_excel(ExcelFile $request)
    {
            $insert_excel_service = new InsertDataFromExcelService();
           return $insert_excel_service->insertExcelStudents($request);

    }
    public function add_work_student_excel(ExcelFile $request)
    {
        $insert_excel_service = new InsertDataFromExcelService();
        return $insert_excel_service->insertExcelWorkStudents($request);
    }
    public function add_student(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertStudent($request);
    }

    public function get_list_student()
    {
            $get_data_service = new GetDataService();
            return $get_data_service->getStudents();
    }

    public function delete_list_student(Request $request){
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteListStudent($request);
    }

    public function delete_student(Request $request)
    {
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteStudent($request);
    }

    public function update_student(Request $request)
    {

        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateStudent($request);
    }
    public function update_avatar_student(Request $request)
    {
        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateAvatarStudent($request);
    }
    public function get_work_student(Request $request)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->getWorkStudent($request);
    }
    public function update_work_student(Request $request,$idEmloyee)
    {
        $update_data_service = new UpdateDataService();
        return $update_data_service->UpdateWorkStudent($request,$idEmloyee);
    }
    public function delete_work_student($id)
    {
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->DeleteWorkStudent($id);
    }
    public function get_list_enterprise()
    {
        return Enterprise::join('users',"users.id","enterprises.id_user")->select('enterprises.name_enterprise',DB::raw('users.user_name as user_enterprise'))->get();
    }
    public function add_work_student(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertWorkStudent($request);

    }
}
