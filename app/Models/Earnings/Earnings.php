<?php

namespace App\Models\Earnings;

use Illuminate\Database\Eloquent\Model;

class Earnings extends Model {

    protected $table = 'earnings';
    protected $fillable = array('amount', 'description', 'date', 'user_id', 'earningsCategory_id');

}
