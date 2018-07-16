<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostCourseController extends Controller
{

    public function index()
    {
        $data = Auth::user()->enterprise->post_courses()->select('id','title_post_course','created_at','accept')->get();

        return $data;
    }


    public function store(Request $request)
    {
        $insert_data_service = new InsertDataService();
        return $insert_data_service->insertPostCourse($request);
    }


    public function show($id)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->enterpriseDetailPostCourse($id);
    }


    public function update(Request $request, $id)
    {


        $update_data_service = new UpdateDataService();
        return $update_data_service->updatePostCourse($request,$id);
    }

    public function destroy($id)
    {
            $delete_data_service = new DeleteDataService();
            return $delete_data_service->deletePostCourse($id);
    }
    public function delete_list_post_course(Request $request)
    {
        $delete_data_service = new DeleteDataService();
        return $delete_data_service->deleteListPostCourse($request);
    }
}
