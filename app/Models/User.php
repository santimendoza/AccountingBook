<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    protected $table = 'users';
    protected $fillable = array('name', 'username', 'lastname', 'email', 'password', 'confirmation_code', 'status', 'premium', 'balance');
    protected $hidden = array('password', 'remember_token');

    public function earningsCategories() {
        return $this->hasMany('EarningsCategories');
    }

    public function expensesCategories() {
        return $this->hasMany('ExpensesCategories');
    }

    public function earnings() {
        return $this->hasMany('App\Models\Earnings\Earnings');
    }

    public function expenses() {
        return $this->hasMany('App\Models\Expenses\Expenses');
    }

    public function savings() {
        return $this->hasMany('App\Models\Savings\Savings');
    }

}
