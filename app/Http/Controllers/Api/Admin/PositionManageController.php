<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\PositionManageRequest;
use App\Services\Api\Productions\Admin\PositionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PositionManageController extends Controller
{
    private $positionService;
    public function __construct()
    {
        $this->positionService = new PositionService();
    }
    public function index()
    {
        return $this->positionService->getAll();
    }

    public function store(PositionManageRequest $request)
    {

        return $this->positionService->save($request);

    }

    public function show($id)
    {
        return $this->positionService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->positionService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->positionService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->positionService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->positionService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->positionService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
