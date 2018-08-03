<?php

namespace App\Http\Controllers\Enterprise;


use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    public function index()
    {
        return view('enterprise.jobs.index');
    }
    public function create()
    {
        return view('enterprise.jobs.create');
    }

    public function edit($id)
    {
        return view('enterprise.jobs.edit',['id' => $id]);
    }
}
