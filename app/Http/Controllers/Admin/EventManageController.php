<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventManageController extends Controller
{

    public function index()
    {
        return view('admin.events.index');
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function edit($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        return view('admin.events.edit',['id' => $enterprise->getKey()]);
    }


}
