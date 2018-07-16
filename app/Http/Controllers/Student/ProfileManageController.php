<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileManageController extends Controller
{
    public function index(){
        $code_student = Auth::user()->user_name;
        return view('student.profile',['code_student' => $code_student]);
    }
}
