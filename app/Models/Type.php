<?php

namespace App\Models;

use App\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $fillable = ['name'];
    public function jobs(){
        return $this->belongsToMany(Job::class,'job_position');
    }
}
