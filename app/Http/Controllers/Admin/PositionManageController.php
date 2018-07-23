<?php
/**
 * Created by PhpStorm.
 * User: daumi
 * Date: 17/07/2018
 * Time: 21:36
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class PositionManageController extends Controller
{
    public function index()
    {
        return view('admin.positions.index');
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function edit($id)
    {
        return view('admin.positions.edit',['id' => $id]);
    }
}