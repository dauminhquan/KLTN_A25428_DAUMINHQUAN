<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:35
 */

namespace App\Services;


use App\Models\PostType;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Post;
use App\Models\PostCity;
use App\Models\PostCourse;
use App\Models\PostPosition;
use App\Models\PostSkill;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InsertDataService
{
    public function insertStudent(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'code_course' => 'required|exists:courses,code_course',
            'code_branch'=> 'required|exists:branches,code_branch',
            'first_name_student' =>'required',
            'last_name_student' => 'required',
            'address_student' =>'required',
            'phone_number_student' => 'required',
            'email_address_student' => 'required|email|unique:students,email_address_student',
            'code_student' => 'required|unique:users,user_name',
            'password' => 'required',
            'rep_password' => 'required|same:password'
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
            'code_student.required' => 'Mã sinh viên không có',
            'code_student.unique' => 'Mã sinh viên đã tồn tại',
            'password.required' => 'Không có password',
            'rep_password.required' => 'Không có nhập lại password',
            'rep_password.same' => 'Nhập lại mật khẩu không đúng'
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors(),406);
        }
        return DB::transaction(function () use ($request) {
            $user = new User();
            $user->user_name = $request->code_student;
            $user->password = $request->password;
            $user->authentication = true;
            $user->type = 3;
            $user->save();
            $student = new Student();
            $student->code_course = $request->code_course;
            $student->code_branch = $request->code_branch;
            $student->first_name_student = $request->first_name_student;
            $student->last_name_student = $request->last_name_student;
            $student->address_student = $request->address_student;
            $student->phone_number_student = $request->phone_number_student;
            $student->id_user = $user->id;
            $student->email_address_student = $request->email_address_student;
            $student->save();
            return response()->json([
                'message' => 'Thêm mới sinh viên thành công'

            ],200);
        });

    }

    public function insertWorkStudent(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email_address_enterprise' => 'required|exists:users,user_name',
            'code_student'=> 'required|exists:users,user_name',
            'started_at' =>'required',
            'position' => 'required',

        ],[
            'email_address_enterprise.required' => 'Không có Email',
            'email_address_enterprise.exists' => 'Doanh nghiệp không tồn tại',
            'code_student.required' => 'Không có mã sinh viên',
            'code_student.exists' => 'SV không tồn tại',
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
        if(User::where('user_name',$request->code_student)->first()->type != 3)
        {
            return response()->json(['message' => 'Sinh viên không tồn tại'],404);
        }

        $employee = new Employee();
        $employee->user_enterprise = $request->email_address_enterprise;
        $employee->code_student = $request->code_student;
        $employee->started_at = $request->started_at;
        $employee->dropped_at = $request->dropped_at;
        $employee->id_salary = $request->id_salary;
        $employee->position = $request->position;
        $employee->save();

    }

    public function insertEnterprise(Request $request)
    {
        $validate = Validator::make($request->all(),[


            'name_enterprise' =>'required',
            'address_enterprise' => 'required',
            'name_president_enterprise' =>'required',
            'phone_number_enterprise' => 'required',
            'email_address_enterprise' => 'required|email|unique:users,user_name',
            'password' => 'required',
            'rep_password' => 'required|same:password'
        ],[
            'name_enterprise.required' => 'Không có tên doanh nghiệp',
            'address_enterprise.required' => 'Không có địa chỉ doanh nghiệp',
            'name_president_enterprise.required' => 'Không có tên tổng giám đốc',

            'phone_number_enterprise.required' => 'Không có số điện thoại',
            'email_address_enterprise.required' => 'Không có Email',
            'email_address_enterprise.unique' => 'Email đã tồn tại',
            'email_address_enterprise.email' => 'Không đúng định dạng Email',
            'password.required' => 'Không có password',
            'rep_password.required' => 'Không có nhập lại password',
            'rep_password.same' => 'Nhập lại mật khẩu không đúng'
        ]);
        if($validate->fails())
        {
            return response()->json($validate->errors(),406);
        }
        return DB::transaction(function () use ($request) {
            $user = new User();
            $user->user_name = $request->email_address_enterprise;
            $user->password = $request->password;
            $user->authentication = true;
            $user->type = 2;
            $user->save();
            $enterprise = new Enterprise();
            $enterprise->id_user = $user->id;
            $enterprise->name_enterprise = $request->name_enterprise;
            $enterprise->address_enterprise = $request->address_enterprise;
            $enterprise->name_president_enterprise = $request->name_president_enterprise;
            $enterprise->phone_number_enterprise = $request->phone_number_enterprise;
            if($request->has('introduce_enterprise'))
            {
                $enterprise->introduce_enterprise = $request->introduce_enterprise;
            }
            $enterprise->save();
            return response()->json([
                'message' => 'Thêm mới doanh nghiệp thành công'

            ],200);
        });
    }

    public function insertPost(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'cities' => 'required',
            'content_post' => 'required',
            'list_positions'=> 'required|array',
            'list_skills'=> 'required|array',
            'list_types'=> 'required|array',
            'location' => 'required',
            'time_end_post' => 'required|date',
            'time_start_post' => 'required|date',
            'title_post' => 'required',
            'description_post' => 'required',
            'file_attach_post' => 'required|file'
        ],[
            'cities.required' => 'Không có thành phố',
            'content_post.required' => 'Nội dung trống',
            'list_positions.required'=> 'Không có vị trí công việc',
            'list_positions.array' => 'Vị trí công việc phải là 1 mảng',
            'list_skills.required'=> 'Không có kỹ năng công việc',
            'list_skills.array' => 'Kỹ năng công việc phải là 1 mảng',
            'list_types.required'=> 'Không có hình thức  công việc',
            'list_types.array' => 'Hình thức công việc phải là 1 mảng',
            'description_post.required' => 'Không có nội dung hiển thị tóm tắt',

            'location.required' => 'Không có địa điểm làm việc',
            'time_end_post.required' => 'Không có thời gian hết hạn',
            'time_end_post.date' => 'Thời gian hết hạn không phải date time',
            'time_start_post.required' => 'Không có thời gian bắt đầu đăng ký',
            'time_start_post.date' => 'Thời gian đăng ký không phải date time',
            'title_post.required' => 'Không có tiêu đề bài viết',
            'file_attach_post.required' => 'File đính kèm không tồn tại',
            'file_attach_post.file' => 'File đính kèm không đúng định dạng'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        try{

            DB::transaction(function () use ($request){
                $post = new Post();
                $post->id_enterprise = Auth::user()->enterprise->id;
                $post->title_post = $request->title_post;
                $post->time_start_post = $request->time_start_post;
                $post->time_end_post = $request->time_end_post;
                $post->description_post = $request->description_post;
                $post->content_post = $request->content_post;
                $post->accept = 0;
                $post->localtion = $request->location;
                $post->file_attach_post = 'none';
                $post->save();
                $post->file_attach_post = $request->file('file_attach_post')->storeAs('public/file_attaches','post_'.$post->id.'_file_attach.'.$request->file('file_attach_post')->getClientOriginalExtension());
                $post->update();
                foreach ($request->cities as $city)
                {
                    $post_city = new PostCity();
                    $post_city->id_post= $post->id;
                    $post_city->city = $city;
                    $post_city->save();
                }
                foreach ($request->list_positions as $position)
                {
                    $post_position = new PostPosition();
                    $post_position->id_post= $post->id;
                    $post_position->id_position = $position;
                    $post_position->save();
                }

                foreach ($request->list_skills as $skill)
                {
                    $list_skills = new PostSkill();
                    $list_skills->id_post= $post->id;
                    $list_skills->id_skill = $skill;
                    $list_skills->save();
                }
                foreach ($request->list_types as $type)
                {

                    $post_type = new PostType();
                    $post_type->id_post= $post->id;
                    $post_type->id_job_type = $type;
                    $post_type->save();
                }

            });
            return ['message' => 'Thêm mới thành công','status' => 1];
        }catch (\Exception $exception)
        {
            return response()->json(['message' => 'Thất bại','error'=> $exception->getMessage(),'status' => 0],500);
        }

    }

    public function insertPostCourse(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'title_post_course' => 'required',
           'content_post_course' => 'required',
            'time_start' => 'required|date',
            'time_end' => 'required|date',
            'description_post_course' => 'required'
        ],[
            'content_post_course.required' => 'Không có nội dung',
            'title_post_course' =>'Không có tiêu đề',
            'time_start.required' => 'Không có thời gian bắt đầu',
            'time_start.date' => 'Thời gian bắt đầu không phải ngày tháng',
            'time_end.required' => 'Không có thời gian kết thúc',
            'time_end.date' => 'Thời gian kết thúc không phải ngày tháng',
            'description_post_course.required' => 'Không có mô tả'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }

        dd($request->all());
        try{
            DB::transaction(function () use($request){
                $post_course = new PostCourse();
                $post_course->id_enterprise = Auth::user()->enterprise->id;
                $post_course->title_post_course = $request->title_post_course;
                $post_course->content_post_course = $request->content_post_course;
                $post_course->file_attach_course = 'none';
                $post_course->location = $request->location;
                $post_course->time_start = $request->time_start;
                $post_course->time_end = $request->time_end;
                $post_course->description_post_course = $request->description_post_course;
                $post_course->save();
                if($request->hasFile('file_attach_course'))
                {
                    $post_course->file_attach_course =   $request->file('file_attach_post_course')->storeAs('/public/file_attaches','post_course_'.$post_course->id.'.'.$request->file('file_attach_post_course')->getClientOriginalExtension());
                    $post_course->update();
                }
            });
            return response()->json(['status' => 1,'message' =>'Thành công'],200);
        }catch (\Exception $exception)
        {
            return response()->json(['status' => 0,'message' =>$exception->getMessage()],500);
        }
    }
}