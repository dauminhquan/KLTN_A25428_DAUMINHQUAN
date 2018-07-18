<?php

namespace App\Models;

use App\Model;

class Department extends Model
{
    protected $primaryKey = 'code';
    protected $fillable = ['code','name'];
    public function branches()
    {
        return $this->hasMany(Branch::class,'department_code','code');
    }

}
