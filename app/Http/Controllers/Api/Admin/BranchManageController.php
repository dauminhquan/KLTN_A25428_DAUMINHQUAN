<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\BranchManageRequest;
use App\Services\Api\Productions\Admin\BranchService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class BranchManageController extends Controller
{
    private $branchService;
    public function __construct()
    {
        $this->branchService = new BranchService();
    }
    public function index()
    {
        return $this->branchService->getAll();
    }

    public function store(BranchManageRequest $request)
    {

        return $this->branchService->save($request);

    }

    public function show($id)
    {
        return $this->branchService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->branchService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->branchService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->branchService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->branchService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->branchService->getOptionCsv($request->file('CsvFile')->getRealPath(),['code']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
