<?php

namespace App\Http\Controllers\Enterprise;


use App\Http\Controllers\Controller;

class TaskManageController extends Controller
{
    public function index()
    {
        return view('enterprise.tasks.index');
    }
    public function create()
    {
        return view('enterprise.tasks.create');
    }

    public function edit($id)
    {
        return view('enterprise.tasks.edit',['id' => $id]);
    }
}
