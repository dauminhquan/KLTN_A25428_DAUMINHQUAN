<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\WorkManageRequest;
use App\Services\Api\Productions\Admin\WorkService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class WorkManageController extends Controller
{
    private $workService;
    public function __construct()
    {
        $this->workService = new WorkService();
    }

    public function index(GetDataRequest $request)
    {
        return $this->workService->getAll($request->all());
    }

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
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->workService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
