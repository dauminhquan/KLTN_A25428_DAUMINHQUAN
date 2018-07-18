<?php

namespace App\Models;

use App\Model;

class Salary extends Model
{
    protected $table='salaries';
    protected $fillable = ['about'];
    protected $hidden = ['created_at','updated_at'];

    public function jobs(){
        return $this->belongsToMany(Job::class,'job_position');
    }
}
