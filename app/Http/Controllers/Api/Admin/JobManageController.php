<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\DeleteListRequest;
use App\Services\Api\Productions\Admin\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class JobManageController extends Controller
{
    private $jobService;
    public function __construct()
    {
        $this->jobService = new JobService();
    }
    public function index()
    {
        return $this->jobService->getAll();
    }

    public function show($id)
    {
        return $this->jobService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->jobService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->jobService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->jobService->delete($request->id_list);
    }
    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->jobService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }

}
