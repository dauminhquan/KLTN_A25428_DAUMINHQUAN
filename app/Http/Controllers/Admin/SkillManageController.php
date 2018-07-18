<?php
/**
 * Created by PhpStorm.
 * User: daumi
 * Date: 17/07/2018
 * Time: 21:37
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class SkillManageController extends Controller
{
    public function index()
    {
        return view('admin.skills.index');
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function edit($id)
    {
        return view('admin.skills.edit',['id' => $id]);
    }
}