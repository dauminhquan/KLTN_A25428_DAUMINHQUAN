<?php

namespace App\Models;



use App\Model;

class Branch extends Model
{
    protected $hidden = [
      'id'
    ];
    public function students()
    {
        return $this->hasMany(Student::class,'branch_code','code');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_code','code');
    }
}

