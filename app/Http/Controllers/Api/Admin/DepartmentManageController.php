<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\DepartmentManageRequest;
use App\Services\Api\Productions\Admin\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentManageController extends Controller
{
    private $departmentService;
    public function __construct()
    {
        $this->departmentService = new DepartmentService();
    }
    public function index()
    {
        return $this->departmentService->getAll();
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
}
