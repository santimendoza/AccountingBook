<?php

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/user', 'UserController');
    Route::get('/user/{{username}}', 'UserController@show');
    Route::get('/newcategory', 'CategoriesController@create');
});
Route::get('/', function() {
    return redirect('/auth/login');
});
Route::get('/signup', 'UserController@create');
Route::post('/user', 'UserController@store');
Route::get('/code/{confirmationcode}', [
    'as' => 'confirmation_path',
    'uses' => 'UserController@confirm'
]);
Route::get('/password-recovery', function() {
    return "Olvide mi contraseña: En construcción";
});
Route::get('/reconfirmation', function() {
    return "Reenviar correo de confirmación: En construcción";
});
Route::get('home', 'HomeController@index');
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
