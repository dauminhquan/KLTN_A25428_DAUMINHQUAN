<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
       if(session('user')->type == 1)
       {
           return view('admin.home');
       }
        if(session('user')->type == 2)
        {
            return view('enterprise.home');
        }
        if(session('user')->type == 3)
        {
            return view('student.home');
        }
        abort(404);
    }
}
