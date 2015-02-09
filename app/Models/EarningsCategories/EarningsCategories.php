<?php

namespace App\Models\EarningsCategories;

use Illuminate\Database\Eloquent\Model;

class EarningsCategories extends Model {

    protected $table = 'earningsCategories';
    protected $fillable = array('slug', 'superior_cat', 'user_id');
    
    /*
     *  Relationships 
     */
    public function users() {
        return $this->belongsTo('User');
    }
}
