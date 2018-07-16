<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    public function notifies(){
        return view('admin.notify.notify');
    }
    public function update_notify($id){
        $notify = Notification::findOrFail($id);
        return view('admin.notify.update_notify',['id' => $id]);
    }
    public function add_notify(){
        return view('admin.notify.add_notify');
    }
    public function edit_notify($id)
    {
        $notify = Notification::findOrFail($id);
        if($notify)
        {
            return view('admin.notify.update_notify',['id'=>$id]);
        }
        return response()->redirectToRoute('home');
    }
}
