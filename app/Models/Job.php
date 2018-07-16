<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $table = 'jobs';

    public function enterprise(){
        return $this->belongsTo(Enterprise::class,'enterprise_id','id');
    }

    public function types(){
        return $this->belongsToMany(Type::class,'job_type');
    }
    public function skills(){
        return $this->belongsToMany(Skill::class,'job_skill');

    }
    public function positions(){
        return $this->belongsToMany(Position::class,'job_position');
    }
    public function salary(){
        return $this->hasOne(Salary::class);
    }
}
