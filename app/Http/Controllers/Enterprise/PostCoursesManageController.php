<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 6/28/2018
 * Time: 10:02 AM
 */

namespace App\Http\Controllers\Enterprise;


use App\Http\Controllers\Controller;

use App\Models\PostCourse;
use Illuminate\Support\Facades\Auth;

class PostCoursesManageController extends Controller
{
    public function new_post_course()
    {
        return view('enterprise.new_post_course');
    }
    public function post_course_manage()
    {
        return view('enterprise.post_course_manage');
    }
    public function update_post_course($id){
        $course = PostCourse::findOrFail($id);
        if($course && $course->id_enterprise == Auth::guard('web')->user()->enterprise->id)
        {
            return view('enterprise.update_post_course',['id'=>$id]);
        }
        return response()->redirectToRoute('home');

    }
}