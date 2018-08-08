<?php

namespace App\Http\Controllers\Api\Admin;



use App\Http\Requests\AccountManageRequest;
use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;

use App\Http\Requests\GetDataRequest;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Api\Productions\Admin\UserService;

class UserManageController extends Controller
{


    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(GetDataRequest $request)
    {

        return $this->userService->getAll($request->all());
    }

    public function store(AccountManageRequest $request)
    {

        $user = $this->userService->save($request->all());
        return $user;
    }

    public function show($id)
    {
        return $this->userService->getOne($id);
    }

    public function update(AccountManageRequest $request, $id)
    {
        return $this->userService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->userService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->userService->delete($request->id_list);
    }


    public function getEnterprise($id)
    {
        return $this->userService->getEnterprise($id);
    }

    public function getStudent($id){
        return $this->userService->getStudent($id);
    }

    public function getAdmin($id){
        return $this->userService->getAdmin($id);
    }

    public function importCsv(CsvRequest $request){
        return $this->userService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->userService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
}
