<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\EventManageRequest;
use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\EventService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class EventManageController extends Controller
{
    private $eventService;
    public function __construct()
    {
        $this->eventService = new EventService();
    }
    public function index(GetDataRequest $request)
    {
        return $this->eventService->getAll($request->all());
    }

    public function store(EventManageRequest $request)
    {
        return $this->eventService->save($request->all());
    }
    public function show($id)
    {
        return $this->eventService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->eventService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->eventService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->eventService->delete($request->id_list);
    }



    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->eventService->getOptionCsv($request->file('CsvFile')->getRealPath(),['code']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
