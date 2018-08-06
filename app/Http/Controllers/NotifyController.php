<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class NotifyController extends Controller
{
    public function index()
    {
        return view('notifies.index');
    }
    public function info($id)
    {
        $notify = Notification::findOrFail($id);
        $notify->admin = $notify->admin;
        return view('notifies.info',['id' => $id]);
    }
    public function file($id)
    {
        try{
            $notify = Post::find($id);
            if($notify != null)
            {
                return Storage::download($notify->file_attach_notify);
            }
        }catch (\Exception $e)
        {
            return ['status' => 0, 'message' => 'File not found'];
        }
        return ['status' => 0, 'message' => 'File not found'];
    }

}
