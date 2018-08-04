<?php

namespace App\Models;



use App\Model;

class Work extends Model
{
    protected $table = 'works';

    protected $fillable =['student_code','enterprise_id','salary_id','rank_id'];

    public function student(){

        return $this->belongsTo(Student::class);
    }
    public function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }
    public function salary(){
        return $this->belongsTo(Salary::class);
    }
    public function rank(){
        return $this->belongsTo(Rank::class);
    }

}
