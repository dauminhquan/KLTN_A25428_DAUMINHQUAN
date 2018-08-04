<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\EventStudentManageRequest;
use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\EventStudentService;
use App\Services\Api\Productions\Admin\EventStudentStudentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class EventStudentManageController extends Controller
{
    private $eventStudentService;
    public function __construct()
    {
        $this->eventStudentService = new EventStudentService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->eventStudentService->getAll($request->all());
    }

    public function store(EventStudentManageRequest $request)
    {
        return $this->eventStudentService->save($request->all());
    }
    public function show($id)
    {
        return $this->eventStudentService->getOne($id);
    }

    public function update(EventStudentManageRequest $request, $id)
    {
        return $this->eventStudentService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->eventStudentService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->eventStudentService->delete($request->id_list);
    }


    public function importCsv(CsvRequest $request){
        return $this->eventStudentService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function updateCsv(CsvRequest $request){
        return $this->eventStudentService->csvUpdate($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->eventStudentService->getOptionCsv($request->file('CsvFile')->getRealPath(),['code']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
