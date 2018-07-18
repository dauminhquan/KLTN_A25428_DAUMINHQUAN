<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\SalaryManageRequest;
use App\Services\Api\Productions\Admin\SalaryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryManageController extends Controller
{
    private $salaryService;
    public function __construct()
    {
        $this->salaryService = new SalaryService();
    }
    public function index()
    {
        return $this->salaryService->getAll();
    }

    public function store(SalaryManageRequest $request)
    {

        return $this->salaryService->save($request);

    }

    public function show($id)
    {
        return $this->salaryService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->salaryService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->salaryService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->salaryService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->salaryService->csvStore($request->file('CsvFile')->getRealPath());
    }
}
