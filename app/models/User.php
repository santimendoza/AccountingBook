<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    protected $table = 'users';
    protected $fillable = array('name', 'username', 'lastname', 'email', 'password', 'confirmation_code', 'status', 'premium');
    protected $hidden = array('password', 'remember_token');

     public function categories(){
         return $this->hasMany('Category');
     }
}
