<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
    //

    protected $table = 'classes';




    public function subjects(){

        return $this->belongsToMany('App\Subject');
    }

    public function students(){

        return $this->belongsToMany('App\Student');
    }
}
