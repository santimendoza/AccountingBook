<?php

namespace App\Models\Savings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Savings extends Model {

    use SoftDeletes;

    protected $table = 'savings';
    protected $fillable = array('amount', 'description', 'title', 'addedfounds', 'user_id');
    protected $dates = array('deleted_at');

    public function users() {
        return $this->belongsTo('User', 'user_id');
    }

}
