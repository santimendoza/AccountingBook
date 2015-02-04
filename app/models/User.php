<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

use UserTrait,
    RemindableTrait;

    protected $table = 'users';
    protected $fillable = array('name', 'username', 'lastname', 'email', 'password', 'confirmation_code', 'status', 'premium');
    protected $hidden = array('password', 'remember_token');

    public function categories() {
        return $this->hasMany('Category');
    }

}
