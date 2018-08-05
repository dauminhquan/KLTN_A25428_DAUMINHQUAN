<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs.index');
    }
    public function info($id)
    {
        $post = Job::findOrFail($id);

        if($post->accept == 1)
        {
            return view('jobs.info',['id' => $id]);
        }
        return response()->redirectToRoute('web.home');
    }
    public function file($id)
    {
        try{
            $post = Post::find($id);
            if($post != null)
            {
                return Storage::download($post->file_attach_post);
            }
        }catch (\Exception $e)
        {
            return ['status' => 0, 'message' => 'File not found'];
        }
        return ['status' => 0, 'message' => 'File not found'];
    }

}
