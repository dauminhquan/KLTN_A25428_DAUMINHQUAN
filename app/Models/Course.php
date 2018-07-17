<?php

namespace App\Models;

use App\Model;

class Course extends Model
{
    protected $table = 'courses';
    public function students()
    {
        return $this->hasMany(Student::class,'course_code','code');
    }
}
