<?php

class Category extends Eloquent {
    protected $table = 'categories';
    protected $fillable = array('slug', 'superior_cat', 'type', 'user_id',);
    //protected $hidden = array('', '');
    
    public function users() {
        return $this->belongsTo('User');
    }
}
