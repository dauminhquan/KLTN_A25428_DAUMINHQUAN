<?php

namespace App\Http\Controllers\Enterprise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileManageController extends Controller
{
    public function index()
    {
        $email_address_enterprise = Auth::user()->user_name;
        return view('enterprise.profile',['email_address_enterprise' => $email_address_enterprise]);
    }


}
