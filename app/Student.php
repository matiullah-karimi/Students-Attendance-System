<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','fname'];


    public function students(){

        return $this->belongsToMany('App\Clas');
    }

    public function classes(){

      return $this->belongsToMany('App\Clas', 'class_student', 'student_id', 'class_id');
    }
}
