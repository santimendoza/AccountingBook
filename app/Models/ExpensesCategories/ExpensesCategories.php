<?php

namespace App\Models\ExpensesCategories;

use Illuminate\Database\Eloquent\Model;

class ExpensesCategories extends Model {

    protected $table = 'expensesCategories';
    protected $fillable = array('slug', 'superior_cat', 'user_id');

    /*
     *  Relationships 
     */

    public function users() {
        return $this->belongsTo('User');
    }

}
