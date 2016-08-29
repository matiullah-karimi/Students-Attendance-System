<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //

    protected $fillable = ['name','email','password'];

    public function subjects(){

        return $this->belongsToMany('App\Subject');
    }

    public function classes()
    {
        return $this->belongsToMany('App\Clas', 'class_teacher', 'class_id', 'teacher_id');
    }


}
