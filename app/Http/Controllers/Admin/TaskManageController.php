<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskManageController extends Controller
{
    public function index()
    {
        return view('admin.tasks.index');
    }

    public function create()
    {
        return view('admin.tasks.create');
    }

    public function edit($id)
    {
        return view('admin.tasks.edit',['id' => $id]);
    }
}
