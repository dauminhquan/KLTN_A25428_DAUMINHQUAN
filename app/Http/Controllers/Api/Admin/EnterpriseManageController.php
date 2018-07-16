<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\EnterpriseManageRequest;
use App\Http\Requests\ExcelFile;
use App\Http\Requests\UpdateAvatarRequest;
use App\Models\Enterprise;
use App\Services\Api\Productions\Admin\EnterpriseService;

use App\Services\DeleteDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\UpdateDataService;
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
    public function excelStore(ExcelFile $request)
    {
        return $this->enterpriseService->excelStore($request->ExcelFileUpload);
    }
    public function updateAvatar(UpdateAvatarRequest $request,$id)
    {
        return $this->enterpriseService->updateAvatar($id,$request->file('avatar'));
    }

}
