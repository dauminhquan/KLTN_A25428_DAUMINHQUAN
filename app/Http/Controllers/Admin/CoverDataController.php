<?php

namespace App\Http\Controllers\Admin;

use App\Services\Api\Productions\Admin\EnterpriseService;
use App\Services\Api\Productions\Admin\RankService;
use App\Services\Api\Productions\Admin\SalaryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CoverDataController extends Controller
{
    public function coverData(){
        return view('admin.cover-data');
    }
    public function postCoverData(Request $request){

        $validator = Validator::make($request->all(),[
            'enterprise-csv' => 'file|mimes:csv,txt',
            'salary-csv' => 'file|mimes:csv,txt',
            'rank-csv' => 'file|mimes:csv,txt',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $this->enterpriseService = new EnterpriseService();
        $this->salaryService = new SalaryService();
        $this->rankService = new RankService();
        $enterpriseCsv = null;
        $salaryCsv = null;
        $rankCsv = null;
        if($request->hasFile('enterprise-csv'))
        {
            $enterpriseCsv = $this->enterpriseService->getOptionCsv($request->file('enterprise-csv')->getRealPath(),['id']);
        }
        if($request->hasFile('salary-csv'))
        {
            $salaryCsv = $this->salaryService->getOptionCsv($request->file('salary-csv')->getRealPath(),['id']);
        }

        if($request->hasFile('rank-csv'))
        {
            $rankCsv = $this->rankService->getOptionCsv($request->file('rank-csv')->getRealPath(),['id']);
        }
        try{
            return Excel::create('CoverFile', function($excel) use($enterpriseCsv,$salaryCsv,$rankCsv) {
                if($enterpriseCsv != null)
                {
                    $excel->sheet('enterprise', function($sheet) use($enterpriseCsv) {
                        $sheet->fromArray($enterpriseCsv);
                    });
                }
                if($salaryCsv != null)
                {
                    $excel->sheet('salary', function($sheet) use($salaryCsv) {
                        $sheet->fromArray($salaryCsv);
                    });
                }
                if($rankCsv != null)
                {
                    $excel->sheet('rank', function($sheet) use($rankCsv) {
                        $sheet->fromArray($rankCsv);
                    });
                }
            })->download('xls');
        }catch (\Exception $exception)
        {
            return abort(404);
        }
        return view('admin.cover-data');
    }
}
