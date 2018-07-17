<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Requests\WorkManageRequest;
use App\Services\Api\Productions\Student\WorkService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkManageController extends Controller
{
    private $workService;
    public function __construct()
    {
        $this->workService = new WorkService();
    }

    public function index()
    {
        return $this->workService->getAll();
    }
/*
    public function store(WorkManageRequest $request)
    {
        $work = Work::create($request->all());
        return $work;
    }

    public function show($id)
    {
        return $this->workService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->workService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->workService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->workService->delete($request->id_list);
    }


    public function importCsv(CsvRequest $request){
        return $this->workService->csvStore($request->file('CsvFile')->getRealPath());
    }*/
}
