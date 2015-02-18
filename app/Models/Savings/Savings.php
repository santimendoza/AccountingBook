<?php

namespace App\Models\Savings;

use Illuminate\Database\Eloquent\Model;

class Savings extends Model {

    protected $table = 'savings';
    protected $fillable = array('amount', 'description', 'title', 'user_id');

    public function users() {
        return $this->belongsTo('User', 'user_id');
    }

}
