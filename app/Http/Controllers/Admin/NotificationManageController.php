<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationManageController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index');
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function edit($id)
    {
        return view('admin.notifications.edit',['id' => $id]);
    }
}
