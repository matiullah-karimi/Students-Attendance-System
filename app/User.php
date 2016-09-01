<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects(){

        return $this->belongsToMany('App\Subject');
    }

    public function classes()
    {
        return $this->belongsToMany('App\Clas', 'class_teacher', 'class_id', 'teacher_id');
    }
}
