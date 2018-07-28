<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\RankManageRequest;
use App\Services\Api\Productions\Admin\RankService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class RankManageController extends Controller
{
    private $rankService;
    public function __construct()
    {
        $this->rankService = new RankService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->rankService->getAll($request->all());
    }

    public function store(RankManageRequest $request)
    {

        return $this->rankService->save($request);

    }

    public function show($id)
    {
        return $this->rankService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->rankService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->rankService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->rankService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->rankService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->rankService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
