<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    public function branches()
    {
        return $this->hasMany(Branch::class,'department_code','code');
    }

}
