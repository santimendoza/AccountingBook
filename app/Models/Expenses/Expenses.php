<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model {

    protected $table = 'expenses';
    protected $fillable = array('amount', 'description', 'date', 'user_id', 'expensesCategory_id');

    public function users() {
        return $this->belongsTo('User', 'user_id');
    }

    public function expensescategories() {
        return $this->belongsTo('App\Models\ExpensesCategories\ExpensesCategories', 'expensesCategory_id');
    }

}
