<?php

namespace App\Models;
use App\Model;

class Student extends Model
{
    protected $primaryKey = 'code';
    protected $keyType = 'String';
    protected $fillable = ['name','code','first_name','last_name','address','sex','phone_number','email_address',
        'birth_day','province_id','introduce','user_id','graduated','medium_score','date_graduated','student_avatar'
    ,'course_code','branch_code','main_class','full_name','rating_id'];
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
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function works(){
        return $this->hasMany(Work::class);
    }
    public function enterprises(){
        return $this->hasManyThrough(Enterprise::class,Work::class);
    }

}
