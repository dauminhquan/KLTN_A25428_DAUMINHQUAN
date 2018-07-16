<?php

namespace App\Http\Controllers\Admin;


use App\Models\PostCourse;

use App\Http\Controllers\Controller;

class PostCourseManageController extends Controller
{


    public function postcoursesManage()
    {
        return view('admin.postcourse.post_courses');
    }
    public function updatePostcourse($id)
    {
        $post_course = PostCourse::findOrFail($id);
        if($post_course)
        {
            return view('admin.postcourse.update_post_course',['id'=>$id]);
        }
        return response()->redirectToRoute('home');
    }

}
