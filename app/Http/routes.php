<?php

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/categories/earnings', 'EarningsCategoriesController');
    Route::resource('/user', 'UserController');
    Route::get('/user/{{username}}', 'UserController@show');
});
Route::get('/', function() {
    return redirect('/auth/login');
});
Route::get('home', 'HomeController@index');
Route::get('/code/{confirmationcode}',
    ['as' => 'confirmation_path',
    'uses' => 'UserController@confirm']
);
Route::get('/reconfirmation', function() {
    return "Reenviar correo de confirmación: En construcción";
});


/*
 * Authentication 
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
