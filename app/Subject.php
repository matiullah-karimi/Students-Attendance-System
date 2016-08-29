<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    public function teachers(){

        return $this->belongsToMany('App\Teacher');
    }

    public function classes(){

        return $this->belongsToMany('App\Class', 'class_subject', 'class_id', 'subject_id');
    }
}
