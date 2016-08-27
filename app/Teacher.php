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


}
