<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStudent extends Model
{
    protected $table='event_student';

    protected $fillable =['student_code','event_id','attended','comment'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
