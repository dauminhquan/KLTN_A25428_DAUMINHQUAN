<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
    public function info($id)
    {
        $user = User::findOrFail($id);
        $user->admin = $user->admin;
        return view('admin.users.info',['id' => $id]);
    }
}
