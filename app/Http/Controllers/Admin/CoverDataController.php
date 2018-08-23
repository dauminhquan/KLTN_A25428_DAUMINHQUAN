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
    public function exportData(Request $request){
        if($request->has('table'))
        {
            if(!$this->hasTable($request->table))
            {
                abort(404);
            }

            try{
                $results = DB::table($request->table)->get();
                $data = array();
                foreach ($results as $result) {
                    $data[] = (array)$result;
                }
                return Excel::create($request->table, function($excel) use($data) {
                    $excel->sheet('table', function($sheet) use($data) {
                        $sheet->fromArray($data);
                    });
                })->download('csv');
            }catch (\Exception $exception)
            {
                return abort(404);
            }
        }
        $databaseName = DB::getDatabaseName();
        $listTable = DB::select('SHOW TABLES');
        $pointer = "Tables_in_$databaseName";

        $tables = [];
        foreach ($listTable as $table)
        {
            $tableName = $table->$pointer;
            if(!$this->filterTable($tableName))
            {
                continue;
            }

            $tables[] = [
                'name' => $tableName,
            ];
        }
        return view('admin.export-data',[
            'tables' => $tables,
        ]);
    }
    public function coverData(){
        $databaseName = DB::getDatabaseName();
        $listTable = DB::select('SHOW TABLES');
        $pointer = "Tables_in_$databaseName";

        $tables = [];

        foreach ($listTable as $table)
        {
            $tableName = $table->$pointer;
            if(!$this->filterTable($tableName))
            {
                continue;
            }
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
                $datas = [];
                foreach ($listTable as  $table)
                {
                    if($request->hasFile($table->$pointer."-csv") && $request->has('rows-'.$table->$pointer))
                    {
                        $data = $this->getOptionCsv($request->file($table->$pointer."-csv")->getRealPath(),$request['rows-'.$table->$pointer],$table->$pointer);
                        $datas[] = [
                          'name' => $table->$pointer,
                            'data' => $data
                        ];
                    }
                }
                foreach ($datas as $data)
                {
                    $excel->sheet($data['name'], function($sheet) use($data) {
                        $sheet->fromArray($data['data']);
                    });
                }

            })->download('xls');
        }catch (\Exception $exception)
        {
            return abort(404);
        }
    }

    public function importData(){
        $databaseName = DB::getDatabaseName();
        $listTable = DB::select('SHOW TABLES');
        $pointer = "Tables_in_$databaseName";

        $tables = [];

        foreach ($listTable as $table)
        {
            $tableName = $table->$pointer;
            if(!$this->filterTable($tableName))
            {
                continue;
            }
            $tables[] = [
                'name' => $tableName,
            ];
        }

        return view('admin.import-data',[
            'tables' => $tables,
        ]);
    }
    public function postImportData(Request $request){
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
            $res = [];
            foreach ($listTable as $table)
            {
                if($request->hasFile($table->$pointer."-csv"))
                {
                    $res[$table->$pointer] = $this->csvStore($request->file($table->$pointer."-csv")->getRealPath(),$table->$pointer);
                }

            }
            return $res;
        }catch (\Exception $exception)
        {
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
    private function csvStore($path,$tableName){
        $list_err = [];
        $size_success = 0;
        $data = Excel::load($path,function($reader){})->get()->toArray();
        if(count($data) > 0)
        {
            foreach ($data as $index => $item)
            {
                try{
                    DB::table($tableName)->insert($item);
                    $size_success++;
                }catch (\Exception $exception)
                {
                    $list_err[] = $index+2;
                }
            }
        }
        return [
            'errors' => ['Danh sach vi tri loi' => $list_err],
            'So luong thanh cong' => $size_success
        ];
    }
    private function filterTable($tableName)
    {
        switch ($tableName)
        {
            case ('notifications'):
            case ('oauth_access_tokens'):
            case ('jobs'):
            case ('migrations'):
            case ('oauth_auth_codes'):
            case ('oauth_clients'):
            case ('oauth_personal_access_clients'):
            case ('oauth_refresh_tokens'):
            case ('sessions'):
                return false;
        }
        return true;
    }
    private function hasTable($tableName)
    {
        $databaseName = DB::getDatabaseName();
        $listTable = DB::select('SHOW TABLES');
        $pointer = "Tables_in_$databaseName";
        foreach ($listTable as $table)
        {
            if($table->$pointer == $tableName)
            {
                return true;
            }

        }
        return false;
    }
}
