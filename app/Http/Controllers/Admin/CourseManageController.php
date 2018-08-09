<?php
/**
 * Created by PhpStorm.
 * User: daumi
 * Date: 17/07/2018
 * Time: 21:38
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class CourseManageController extends Controller
{
    public function index()
    {
        return view('admin.courses.index');
    }

}