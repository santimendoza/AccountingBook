<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $table = 'categories';
    protected $fillable = array('slug', 'superior_cat', 'type', 'user_id',);
    //protected $hidden = array('', '');
    
    public function users() {
        return $this->belongsTo('User');
    }
}
