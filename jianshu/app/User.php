<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public  function posts(){

        return $this->hasMany('App\Post');
    }
    public function fans(){
        return $this->hasMany('App\Fan','fan_id','id');
    }
    public function stars(){
        return $this->hasMany('App\Fan','star_id','id');
    }
    public function hasFan($user_id){

        return $this->stars->where('fan_id',$user_id)->count();
    }
}
