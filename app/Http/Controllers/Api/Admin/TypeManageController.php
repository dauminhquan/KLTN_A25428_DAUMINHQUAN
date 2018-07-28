<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\TypeManageRequest;
use App\Services\Api\Productions\Admin\TypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TypeManageController extends Controller
{
    private $typeService;
    public function __construct()
    {
        $this->typeService = new TypeService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->typeService->getAll($request->all());
    }

    public function store(TypeManageRequest $request)
    {

        return $this->typeService->save($request);

    }

    public function show($id)
    {
        return $this->typeService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->typeService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->typeService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->typeService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->typeService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->typeService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
