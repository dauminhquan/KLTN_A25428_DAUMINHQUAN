<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\SkillManageRequest;
use App\Services\Api\Productions\Admin\SkillService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillManageController extends Controller
{
    private $skillService;
    public function __construct()
    {
        $this->skillService = new SkillService();
    }
    public function index()
    {
        return $this->skillService->getAll();
    }

    public function store(SkillManageRequest $request)
    {

        return $this->skillService->save($request);

    }

    public function show($id)
    {
        return $this->skillService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->skillService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->skillService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->skillService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->skillService->csvStore($request->file('CsvFile')->getRealPath());
    }
}
