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
