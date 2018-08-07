<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['title','description','content','time_start','location','introduce','admin_id'];

    public function students(){
        return $this->belongsToMany(Student::class,'event_student');
    }
    public function event_students(){
        return $this->hasMany(EventStudent::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
