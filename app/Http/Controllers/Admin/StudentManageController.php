<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentManageController extends Controller
{
    public function index()
    {
        return view('admin.students.index');
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function edit($id)
    {
        return view('admin.students.edit',['id' => $id]);
    }
}
