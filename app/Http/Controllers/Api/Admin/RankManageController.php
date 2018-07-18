<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\RankManageRequest;
use App\Services\Api\Productions\Admin\RankService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankManageController extends Controller
{
    private $rankService;
    public function __construct()
    {
        $this->rankService = new RankService();
    }
    public function index()
    {
        return $this->rankService->getAll();
    }

    public function store(RankManageRequest $request)
    {

        return $this->rankService->save($request);

    }

    public function show($id)
    {
        return $this->rankService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->rankService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->rankService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->rankService->delete($request->id_list);
    }

    public function importCsv(CsvRequest $request){
        return $this->rankService->csvStore($request->file('CsvFile')->getRealPath());
    }
}
