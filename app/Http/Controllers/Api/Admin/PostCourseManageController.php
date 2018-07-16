<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Enterprise;
use App\Models\Position;
use App\Models\Post;
use App\Models\PostCourse;
use App\Models\Skill;
use App\Models\User;
use App\Services\GetDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostCourseManageController extends Controller
{

    public function get_list_post_course(Request $request)
    {
        if($request->has('email_address_enterprise'))
        {
            if(Auth::user()->type == 2)
            {
                if(Auth::user()->user_name != $request->email_address_enterprise)
                {
                    return response()->json(['message' => 'Khong du quyen'],406);
                }
            }
            $user = User::where('user_name',$request->email_address_enterprise)->first();
            if($user != null)
            {
                $id_enterprise = $user->enterprise->id;
                return Enterprise::findOrFail($id_enterprise)->post_courses()->select('accept','created_at','id','title_post_course')->get();
            }
            return [];
        }


        $post_courses = PostCourse::all();
        foreach ($post_courses as $item)
        {
//

            $item->enterprise = $item->enterprise()->select('id','name_enterprise','avatar_enterprise','id_user')->first();

            $user_name = $item->enterprise->user()->select('user_name')->first();
            $item->enterprise->user_name = $user_name->user_name;
        }
        return $post_courses;
    }
    public function accept_post_course($id)
    {
        $post_courses = PostCourse::findOrFail($id);

        $post_courses->accept = 1;
        $post_courses->update();
        return ['status' => 1,'message' =>'Chấp nhận bài viết thành công'];
    }
    public function get_detail_post_course($id)
    {
        $get_data_service = new GetDataService();
        return $get_data_service->adminGetDetailPostCourse($id);

    }
}
