<?php
/**
 * Created by PhpStorm.
 * User: daumi
 * Date: 17/07/2018
 * Time: 21:38
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course;

class StatisticalManageController extends Controller
{
    public function index()
    {
        $courses = Course::select(['code','name'])->get();
        return view('admin.statistics.index',[
            'courses' => $courses
        ]);
    }

}