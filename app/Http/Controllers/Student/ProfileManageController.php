<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileManageController extends Controller
{
    public function index(){
        $code = Auth::user()->student->code;
        return view('student.profile.index',['code' => $code]);
    }
    public function update(){
        return view('student.profile.update',['code' => Auth::user()->student->code]);
    }
}
