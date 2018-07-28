<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\DepartmentManageRequest;
use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentManageController extends Controller
{
    private $departmentService;
    public function __construct()
    {
        $this->departmentService = new DepartmentService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->departmentService->getAll($request->all());
    }

    public function store(DepartmentManageRequest $request)
    {

        return $this->departmentService->save($request);

    }

    public function show($id)
    {
        return $this->departmentService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->departmentService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->departmentService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->departmentService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->departmentService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->departmentService->getOptionCsv($request->file('CsvFile')->getRealPath(),['code']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
