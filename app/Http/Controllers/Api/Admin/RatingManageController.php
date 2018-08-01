<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\RatingManageRequest;
use App\Services\Api\Productions\Admin\RatingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class RatingManageController extends Controller
{
    private $ratingService;
    public function __construct()
    {
        $this->ratingService = new RatingService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->ratingService->getAll($request->all());
    }

    public function store(RatingManageRequest $request)
    {

        return $this->ratingService->save($request);

    }

    public function show($id)
    {
        return $this->ratingService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->ratingService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->ratingService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->ratingService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->ratingService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->ratingService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
