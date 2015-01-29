<?php

Route::group(array('before' => 'auth'), function() {
    Route::resource('/user', 'UserController');
    
    Route::get('/logout', 'SessionsController@destroy');
});


Route::get('/', 'HomeController@showWelcome');

Route::resource('/sessions', 'SessionsController');
Route::get('/login', 'SessionsController@create');

