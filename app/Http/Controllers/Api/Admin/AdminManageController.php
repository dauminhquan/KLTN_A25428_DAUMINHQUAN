<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\AdminManageRequest;
use App\Services\Api\Productions\Admin\AdminService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminManageController extends Controller
{
    private $adminService;
    public function __construct()
    {
        $this->adminService = new AdminService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->adminService->getAll($request->all());
    }

    public function store(AdminManageRequest $request)
    {

        return $this->adminService->save($request);

    }

    public function show($id)
    {
        return $this->adminService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->adminService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->adminService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->adminService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->adminService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->adminService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
