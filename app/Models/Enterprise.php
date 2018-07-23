<?php

namespace App\Models;

use App\Model;


class Enterprise extends Model
{
    //
    protected $table = 'enterprises';
    protected $fillable = ['name','address','name_president','phone_number','email_address','introduce'];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function jobs(){
        return $this->hasMany(Job::class,'enterprise_id','id');
    }
    public function students(){
        return $this->belongsToMany(Student::class,(new Work())->getTable(),'enterprise_id','student_code','id','code');
    }

}
