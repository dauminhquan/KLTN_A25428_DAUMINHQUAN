<?php
/**
 * Created by PhpStorm.
 * User: daumi
 * Date: 17/07/2018
 * Time: 21:38
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class WorkManageController extends Controller
{
    public function index()
    {
        return view('admin.types.index');
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function edit($id)
    {
        return view('admin.types.edit',['id' => $id]);
    }
}