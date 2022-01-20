<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
      'user_id','name','password', 'email', 'role'
    ];

    protected $hidden = [
      'password','remember_token'
    ];

    protected $primaryKey = 'user_id';

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function book(){
        return $this->hasMany('App\Models\Book', 'user_id');
    }

}
