<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\EnterpriseManageRequest;

use App\Http\Requests\UpdateAvatarRequest;
use App\Models\Enterprise;
use App\Services\Api\Productions\Admin\EnterpriseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EnterpriseManageController extends Controller
{
    private $enterpriseService;
    public function __construct()
    {
        $this->enterpriseService = new EnterpriseService();
    }

    public function index()
    {
        return $this->enterpriseService->getAll();
    }

    public function store(EnterpriseManageRequest $request)
    {
        $enterprise = Enterprise::create($request->all());
        return $enterprise;
    }

    public function show($id)
    {
        return $this->enterpriseService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->enterpriseService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->enterpriseService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->enterpriseService->delete($request->id_list);
    }

    public function updateAvatar(UpdateAvatarRequest $request,$id)
    {
        return $this->enterpriseService->updateAvatar($id,$request->file('avatar'));
    }

    public function listStudent($id)
    {
        return $this->enterpriseService->getListStudent($id);
    }

    public function listJob($id){
        return $this->enterpriseService->getListJob($id);
    }

    public function importCsv(CsvRequest $request){
        return $this->enterpriseService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->enterpriseService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
    public function getUser($id){
        return $this->enterpriseService->getUser($id);
    }
}
