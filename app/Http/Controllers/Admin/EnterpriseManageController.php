<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterpriseManageController extends Controller
{

    public function index()
    {
        return view('admin.manageenterprises.index');
    }


    public function create()
    {
        return view('admin.manageenterprises.create');
    }



    public function edit($id)
    {
        return view('admin.manageenterprises.edit',['id' => $id]);
    }

    public function get_excel_info_enterprise(){
        $info_enterprise = Enterprise::all();
        return response()->download(Excel::create('enterprise-excel', function($excel) use($info_enterprise) {
            $excel->sheet('enterprise', function($sheet) use($info_enterprise) {
                $sheet->fromArray($info_enterprise);
            });
        })->export('csv'));
    }
    /*public function get_excel_example_info_enterprise(){
        return response()->download(Excel::create('example-enterprise-excel', function($excel) {
            $excel->sheet('enterprise', function($sheet) {
                $sheet->fromArray([
                    'email_address_enterprise',
                    'password',
                    'name_enterprise',
                    'address_enterprise',
                    'name_president_enterprise',
                    'phone_number_enterprise',
                    'avatar_enterprise',
                    'introduce_enterprise'
                ]);
            });
        })->export('xls'));
    }*/
}
