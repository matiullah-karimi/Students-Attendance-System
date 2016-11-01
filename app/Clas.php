<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    //

    protected $table = 'classes';
    protected $fillable = ['name'];




    public function subjects(){

        return $this->belongsToMany('App\Subject', 'class_subject', 'class_id', 'subject_id')->withTimestamps();
    }

    public function students(){

        return $this->belongsToMany('App\Student', 'class_student', 'class_id', 'student_id')->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany('App\User', 'class_user', 'class_id', 'user_id')->withTimestamps();
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
}
