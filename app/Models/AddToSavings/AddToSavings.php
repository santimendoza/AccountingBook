<?php

namespace App\Models\AddToSavings;

use Illuminate\Database\Eloquent\Model;

class AddToSavings extends Model {

    protected $table = 'addtosavings';
    protected $fillable = array('amount', 'date', 'user_id', 'savings_id');

    public function users() {
        return $this->belongsTo('User', 'user_id');
    }

    public function savings() {
        return $this->belongsTo('App\Models\Savings\Savings', 'savings_id');
    }

}
