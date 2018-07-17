<?php

namespace App\Models;
use App\Model;

class Student extends Model
{
    protected $hidden = [

    ];
//    protected $fillable = ['name',]
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
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function works(){
        return $this->hasMany(Work::class);
    }

    public function enterprises(){
        return $this->hasManyThrough(Enterprise::class,Work::class);
    }

}
