<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\ProvinceManageRequest;
use App\Services\Api\Productions\Admin\ProvinceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ProvinceManageController extends Controller
{
    private $provinceService;
    public function __construct()
    {
        $this->provinceService = new ProvinceService();
    }
    public function index()
    {
        return $this->provinceService->getAll();
    }

    public function store(ProvinceManageRequest $request)
    {

        return $this->provinceService->save($request);

    }

    public function show($id)
    {
        return $this->provinceService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->provinceService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->provinceService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->provinceService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->provinceService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function getOptionsCsv(CsvRequest $request)
    {

        $data = $this->provinceService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
