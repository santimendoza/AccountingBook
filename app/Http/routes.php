<?php

Route::group(['middleware' => 'auth'], function() {
    //Categories routes
    Route::resource('/categories/earnings', 'EarningsCategoriesController');
    Route::resource('/categories/expenses', 'ExpensesCategoriesController');

    //Earnings
    Route::resource('/earnings', 'EarningsController');
    Route::post('/earnings/reports', 'ReportsController@earningsreport');

    //Expenses
    Route::resource('/expenses', 'ExpensesController');
    Route::post('/expenses/reports', 'ReportsController@expensesreport');

    //Savings
    Route::resource('/savings', 'SavingsController');
    Route::resource('/savings/add', 'AddToSavingsController');

    //User Routes
    Route::resource('/user', 'UserController');
    Route::get('/user/{{username}}', 'UserController@show');

    //Dashboard
    Route::get('/dashboard', 'DashboardController@expensesCategoriesPercent');
});

//General Routes
Route::get('/', function() {
    return redirect('/auth/login');
});
Route::get('home', 'HomeController@index');

// Authentication and register
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/*Route::get('/code/{confirmationcode}', ['as' => 'confirmation_path',
    'uses' => 'UserController@confirm']
);
Route::get('/reconfirmation', function() {
    return "Reenviar correo de confirmación: En construcción";
});*/
