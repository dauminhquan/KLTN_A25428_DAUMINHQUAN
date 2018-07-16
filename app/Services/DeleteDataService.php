<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:20
 */

namespace App\Services;


use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Post;
use App\Models\PostCourse;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DeleteDataService
{
    public  function deleteListStudent(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'list_id_student' => 'required'
        ],[
            'list_id_student.required' => 'Danh sách sinh viên không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ],400);
        }
        else{
            $list_id_student = $request->list_id_student;
            foreach ($list_id_student as $item)
            {
                $student = Student::find((int)$item);
                $id_user = $student->id_user;
                Storage::delete(str_replace('/storage','public',$student->avatar_student));
                $student->delete();
                User::find($id_user)->delete();

            }
        }
    }
    public  function deleteStudent(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'id' => 'required|exists:students,id'
        ],[
            'id.required' => 'Id sinh viên không có',
            'id.exists' => 'Sinh viên không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ],400);
        }else{
            $student = Student::find((int)$request->id);
            $id_user = $student->id_user;
            Storage::delete(str_replace('/storage','public',$student->avatar_student));
            $student->delete();
            User::find($id_user)->delete();
        }
    }

    public function DeleteWorkStudent($id)
    {
        $employee = Employee::find($id);
        if($employee != null)
        {
            $employee->delete();
        }
        return ['message' => 'Xóa thành công'];
    }
    public function deleteEnterprise(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'id' => 'required|exists:enterprises,id'
        ],[
            'id.required' => 'Id doanh nghiệp không có',
            'id.exists' => 'Doanh nghiệp không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ]);
        }else{
            $enterprise = Enterprise::find((int)$request->id);
            $id_user = $enterprise->id_user;
            Storage::delete(str_replace('/storage','public',$enterprise->avatar_enterprise));
            $enterprise->delete();
            User::find($id_user)->delete();
        }
    }
    public function deleteListEnterprises(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'list_id_enterprise' => 'required'
        ],[
            'list_id_enterprise.required' => 'Danh sách doanh nghiệp không tồn tại'
        ]);
        if($validate->fails())
        {
            return response()->json([
                'message' => $validate->errors()
            ]);
        }
        else{
            $list_id_enterprise = $request->list_id_enterprise;
            foreach ($list_id_enterprise as $item)
            {
                $enterprise = Enterprise::find((int)$item);
                $id_user = $enterprise->id_user;
                Storage::delete(str_replace('/storage','public',$enterprise->avatar_enterprise));

                $enterprise->delete();
                User::find($id_user)->delete();

            }
        }
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);
        if($post)
        {
            Storage::delete($post->file_attach_post);
            $post->delete();
            return ['status' => 1,'message' => 'Xóa bài viết thành công'];

        }
        return response(['status' => 0,'message' => 'Xóa bài viết thất bại| Bài viết không tồn tại'],400);
    }
    public function deleteListPost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'list_id_post' => 'required|array'
        ],[
            'list_id_post.required' => 'Không có danh sách ID',
            'list_id_post.array' => 'Không phải danh sách ID'
        ]);
        if($validator->fails())
        {
            return response($validator->errors(),400);
        }
        try{

            $data = $request->list_id_post;
            foreach ($data as $item)
            {
                $post = Post::find($item);
                Storage::delete($post->file_attach_post);
                $post->delete();
            }
            return ['status' => 1,'message' => 'Xóa thành công'];
        }catch (\Exception $exception)
        {
            return response(['status' => 0,'message' => 'Đã có lỗi xảy ra'],500);
        }
    }
    public function deletePostCourse($id)
    {
        $post_course = PostCourse::findOrFail($id);
        Storage::delete($post_course->file_attach_course);
        $post_course->delete();

        return ['status' => 1,'message' => 'Xóa thành công'];
    }
    public function deleteListPostCourse(Request $request){
        $validator = Validator::make($request->all(),[
            'list_id_post_course' => 'required|array'
        ],[
            'list_id_post_course.required' => 'Không có danh sách ID',
            'list_id_post_course.array' => 'Không phải danh sách ID'
        ]);
        if($validator->fails())
        {
            return response($validator->errors(),400);
        }
        try{

            $data = $request->list_id_post_course;
            foreach ($data as $item)
            {
                $post_course = PostCourse::findOrFail($item);
                Storage::delete($post_course->file_attach_course);
                $post_course->delete();
            }
            return ['status' => 1,'message' => 'Xóa thành công'];
        }catch (\Exception $exception)
        {
            return response(['status' => 0,'message' => $exception->getMessage()],500);
        }
    }

}