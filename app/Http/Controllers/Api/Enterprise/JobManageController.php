<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\FileAttach;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\JobManageRequest;
use App\Services\Api\Productions\Enterprise\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    private $jobService;
    public function __construct()
    {

        $this->jobService = new JobService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->jobService->getAll($request->all());
    }

    public function store(JobManageRequest $request)
    {
        return $this->jobService->save($request);
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
    public function updateFileAttach(FileAttach $request,$id)
    {
        return $this->jobService->updateFileAttach($request->file('file_attach'),$id);
    }
}
