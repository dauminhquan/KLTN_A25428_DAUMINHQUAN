<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/19/2018
 * Time: 11:36 AM
 */

namespace App\Services\Api\Productions\Admin;


use Maatwebsite\Excel\Facades\Excel;

class BaseService
{
    protected $model;
    public function getOptionCsv($path,array $selects){
        $data = Excel::load($path)->get()->toArray();
        $results = [];
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                $keys = array_keys((array)$item);
                $result = [];
                $rs = $this->model->getOption($keys[0],$item[$keys[0]],$selects);
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
}
