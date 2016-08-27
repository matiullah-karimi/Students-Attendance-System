<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','fname'];


    public function students(){

        return $this->belongsToMany('App\Class');
    }
}
