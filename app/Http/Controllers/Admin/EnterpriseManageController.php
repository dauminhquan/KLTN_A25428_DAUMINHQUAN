<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterpriseManageController extends Controller
{

    public function index()
    {
        return view('admin.enterprises.index');
    }

    public function create()
    {
        return view('admin.enterprises.create');
    }

    public function edit($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        return view('admin.enterprises.edit',['id' => $enterprise->getKey()]);
    }


    public function get_excel_info_enterprise(){
        $info_enterprise = Enterprise::all();
        return response()->download(Excel::create('enterprise-excel', function($excel) use($info_enterprise) {
            $excel->sheet('enterprise', function($sheet) use($info_enterprise) {
                $sheet->fromArray($info_enterprise);
            });
        })->export('csv'));
    }

}
