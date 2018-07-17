<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\NotificationManageRequest;
use App\Models\Notification;
use App\Services\Api\Productions\Admin\NotificationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    private $notificationService;
    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }

    public function index()
    {
        return $this->notificationService->getAll();
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


}
