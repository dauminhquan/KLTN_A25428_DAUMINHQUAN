<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }
    public function info($id)
    {
        $post = Task::findOrFail($id);

        if($post->accept == 1)
        {
            return view('tasks.info',['id' => $id]);
        }
        return abort(404);
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

    public function getFile($id){
        $task = Task::findOrFail($id);
        if(Storage::exists($task->attachment))
        {
            return Storage::download($task->attachment);
        }
        return abort(404);
    }
}
