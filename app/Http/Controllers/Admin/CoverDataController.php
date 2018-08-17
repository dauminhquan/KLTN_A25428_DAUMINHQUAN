<?php

namespace App\Http\Controllers\Admin;

use App\Model;
use App\Services\Api\Productions\Admin\BaseService;
use App\Services\Api\Productions\Admin\EnterpriseService;
use App\Services\Api\Productions\Admin\RankService;
use App\Services\Api\Productions\Admin\SalaryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CoverDataController extends Controller
{
    public function coverData(){
        $databaseName = DB::getDatabaseName();
        $listTable = DB::select('SHOW TABLES');
        $pointer = "Tables_in_$databaseName";

        $tables = [];

        foreach ($listTable as $table)
        {
            $tableName = $table->$pointer;

            $rows = Schema::getColumnListing($tableName);

            $tables[] = [
                'name' => $tableName,
                'rows' => $rows
            ];
        }

        return view('admin.cover-data',[
            'tables' => $tables,
        ]);
    }

    /*
     * Request gửi lên gồm:
     * List table = tableName + -csv
     *
     * List row mỗi table: rows-tableName
     *
     * */

    public function postCoverData(Request $request){
        $databaseName = DB::getDatabaseName();
        $listTable = DB::select('SHOW TABLES');
        $pointer = "Tables_in_$databaseName";
        $rules = [];
        foreach ($listTable as $table)
        {
            $rules[$table->$pointer."-csv"] =  "file|mimes:csv,txt";
        }

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return $validator->errors();
        }
        try{
            return Excel::create('CoverFile', function($excel) use($listTable,$request,$pointer) {
                foreach ($listTable as $table)
                {

                    if($request->hasFile($table->$pointer."-csv") && $request->has('rows-'.$table->$pointer))
                    {
                        $data = $this->getOptionCsv($request->file($table->$pointer."-csv")->getRealPath(),$request['rows-'.$table->$pointer],$table->$pointer);
                        $excel->sheet($table->$pointer, function($sheet) use($data) {
                            $sheet->fromArray($data);
                        });
                    }
                }

            })->download('xls');
        }catch (\Exception $exception)
        {
            dd($exception);
            return abort(404);
        }
    }
    private function getOptionCsv($path,array $selects,$tableName){
        $data = Excel::load($path)->get()->toArray();
        $results = [];
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                $keys = array_keys((array)$item);
                $result = [];
                $rs = $this->getOption($keys[0],$item[$keys[0]],$selects,$tableName);
                foreach ($selects as $select)
                {
                    if($rs != null)
                    {
                        $result[$select] = $rs->$select;
                    }
                    else{
                        $result[$select] = null;
                    }
                }
                $result[$keys[0]] = $item[$keys[0]];
                $results[] = $result;
            }
        }
        return $results;
    }
    private function getOption($column,$queryValue,$selects,$tableName)
    {
        $columns = Schema::getColumnListing($tableName);
        if($queryValue == null)
        {
            return null;
        }
        if(in_array($column,$columns))
        {
            return DB::table($tableName)->select($selects)->where($column,$queryValue)->first();
        }
        return null;
    }
}
