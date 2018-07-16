<?php

namespace App\Http\Controllers\Enterprise;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsManageController extends Controller
{

    public function new_post()
    {
        return view('enterprise.new_post');
    }
    public function post_manage()
    {
        return view('enterprise.post_manage');
    }
    public function update_post($id){
        $post = Post::findOrFail($id);
        if($post && $post->id_enterprise == Auth::guard('web')->user()->enterprise->id)
        {
            return view('enterprise.update_post',['id'=>$id]);
        }
        return response()->redirectToRoute('home');

    }
}
