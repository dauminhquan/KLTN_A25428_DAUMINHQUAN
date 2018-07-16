<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $hidden = [

    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_code','code');
    }
    public function course()
    {
        return $this->belongsTo(Course::class,'course_code','code');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
}
