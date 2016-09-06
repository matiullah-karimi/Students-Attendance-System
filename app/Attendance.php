<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = ['subject_id', 'teacher_id', 'class_id', 'date'];

    public function students(){
        return $this->belongsToMany('App\Student')->withPivot('status');
    }

    public function subject(){
        return $this->belongsTo('App\Subject');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function clas(){
        return $this->belongsTo('App\Clas');
    }

}
