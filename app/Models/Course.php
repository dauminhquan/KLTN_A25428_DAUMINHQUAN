<?php

namespace App\Models;

use App\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name','code'];
    protected $primaryKey = 'code';
    protected $keyType = 'String';
    public function students()
    {
        return $this->hasMany(Student::class,'course_code','code');
    }
}
