<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\TypeManageRequest;
use App\Services\Api\Productions\Admin\TypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeManageController extends Controller
{
    private $typeService;
    public function __construct()
    {
        $this->typeService = new TypeService();
    }
    public function index()
    {
        return $this->typeService->getAll();
    }

    public function store(TypeManageRequest $request)
    {

        return $this->typeService->save($request);

    }

    public function show($id)
    {
        return $this->typeService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->typeService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->typeService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->typeService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->typeService->csvStore($request->file('CsvFile')->getRealPath());
    }
}
