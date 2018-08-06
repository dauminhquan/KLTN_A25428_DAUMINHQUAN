<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\FileAttach;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\TaskManageRequest;
use App\Services\Api\Productions\Enterprise\TaskService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskManageController extends Controller
{
    private $taskService;
    public function __construct()
    {

        $this->taskService = new TaskService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->taskService->getAll($request->all());
    }

    public function store(TaskManageRequest $request)
    {
        return $this->taskService->save($request);
    }
    public function show($id)
    {
        return $this->taskService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->taskService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->taskService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->taskService->delete($request->id_list);
    }

    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->taskService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
    public function updateFileAttach(FileAttach $request,$id)
    {
        return $this->taskService->updateFileAttach($request->file('file_attach'),$id);
    }
}
