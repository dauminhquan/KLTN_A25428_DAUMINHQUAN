<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{

    public function positionsManage()
    {
        return view('admin.post.position');
    }
    public function skillsManage()
    {
        return view('admin.post.skill');
    }
    public function jobsManage()
    {
        return view('admin.post.posts');
    }
    public function updateJob($id)
    {
        $post = Post::findOrFail($id);
        if($post)
        {
            return view('admin.post.update_post',['id'=>$id]);
        }
        return response()->redirectToRoute('home');
    }

}
