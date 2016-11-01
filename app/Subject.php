<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function teachers(){

        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function classes(){

        return $this->belongsToMany('App\Clas', 'class_subject', 'subject_id', 'class_id')->withTimestamps();
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
}
