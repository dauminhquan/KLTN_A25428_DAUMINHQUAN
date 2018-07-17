<?php

namespace App\Models;

use App\Model;

class Position extends Model
{
    //
    protected $table = 'positions';
    protected $fillable = ['name'];
    public function jobs(){
        return $this->belongsToMany(Job::class,'job_position');
    }
}
