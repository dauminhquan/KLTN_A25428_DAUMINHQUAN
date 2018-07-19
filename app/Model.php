<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Facades\Schema;

class Model extends BaseModel
{
    public function getTableName(){
        return $this->table;
    }
    public function getOption($column,$queryValue,$selects)
    {

        $columns = Schema::getColumnListing(self::getTable());
//        dd($queryValue);
        if(in_array($column,$columns))
        {

            return $this->select($selects)->where($column,'like',$queryValue)->first();
        }
        return null;
    }

}
