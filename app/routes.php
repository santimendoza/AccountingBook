<?php

Route::group(array('before' => 'auth'), function() {
    Route::resource('/user', 'UserController');
    
    Route::get('/logout', 'SessionsController@destroy');
});


Route::get('/', 'SessionsController@create');

Route::resource('/sessions', 'SessionsController');
Route::resource('/categories', 'CategoriesController');


Route::get('/newcategory', 'CategoriesController@create');
Route::get('/login', 'SessionsController@create');
Route::get('/user/{{username}}', 'UserController@show');
