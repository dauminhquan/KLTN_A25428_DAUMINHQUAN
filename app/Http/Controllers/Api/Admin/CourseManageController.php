<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\CourseManageRequest;
use App\Services\Api\Productions\Admin\CourseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CourseManageController extends Controller
{
    private $courseService;
    public function __construct()
    {
        $this->courseService = new CourseService();
    }
    public function index()
    {
        return $this->courseService->getAll();
    }

    public function store(CourseManageRequest $request)
    {

        return $this->courseService->save($request);

    }

    public function show($id)
    {
        return $this->courseService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->courseService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->courseService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->courseService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->courseService->csvStore($request->file('CsvFile')->getRealPath());
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->courseService->getOptionCsv($request->file('CsvFile')->getRealPath(),['code']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
