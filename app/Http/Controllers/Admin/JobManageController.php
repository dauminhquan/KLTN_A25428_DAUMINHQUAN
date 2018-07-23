<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    public function index()
    {
        return view('admin.jobs.index');
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function edit($id)
    {
        return view('admin.jobs.edit',['id' => $id]);
    }
}
