<?php

namespace App\Models\Earnings;

use Illuminate\Database\Eloquent\Model;

class Earnings extends Model {

    protected $table = 'earnings';
    protected $fillable = array('amount', 'description', 'date', 'user_id', 'earningsCategory_id');

    public function users() {
        return $this->belongsTo('User');
    }

    public function earningscategories() {
        return $this->belongsTo('App\Models\EarningsCategories\EarningsCategories', 'earningsCategory_id');
    }

}
