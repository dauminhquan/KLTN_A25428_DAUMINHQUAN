<?php

namespace App\Models;



use App\Model;

class Work extends Model
{
    protected $table = 'works';

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
