<?php

Route::group(array('before' => 'auth'), function() {
    Route::resource('/user', 'UserController');
    Route::resource('/categories', 'CategoriesController');
    Route::get('/logout', 'SessionsController@destroy');
    Route::get('/user/{{username}}', 'UserController@show');
    Route::get('/newcategory', 'CategoriesController@create');
});


Route::get('/', 'SessionsController@create');
Route::resource('/sessions', 'SessionsController');
Route::get('/login', 'SessionsController@create');
