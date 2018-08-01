<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\NotificationManageRequest;
use App\Services\Api\Productions\Admin\NotificationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class NotificationManageController extends Controller
{
    private $notificationService;
    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    public function index(GetDataRequest $request)
    {
        return $this->notificationService->getAll($request->all());
    }

    public function store(NotificationManageRequest $request)
    {
        return $this->notificationService->save($request->all());

    }

    public function show($id)
    {
        return $this->notificationService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->notificationService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->notificationService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->notificationService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->notificationService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->notificationService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }

}
