<?php

Route::group(['middleware' => 'auth'], function() {
    //Categories routes
    Route::resource('/categories/earnings', 'EarningsCategoriesController');
    Route::resource('/categories/expenses', 'ExpensesCategoriesController');
    Route::post('/categories/expenses/{id}/reports', 'ReportsController@expensesCategoryReport');

    //Earnings
    Route::resource('/earnings', 'EarningsController');
    Route::post('/earnings/reports', 'ReportsController@earningsreport');

    //Expenses
    Route::resource('/expenses', 'ExpensesController');
    Route::post('/expenses/reports', 'ReportsController@expensesreport');

    //Savings
    Route::resource('/savings', 'SavingsController');
    Route::get('/savings/{id}/add', 'SavingsController@addFounds');
    Route::post('/savings/{id}/updateAmount', 'SavingsController@updateAmount');
    Route::get('/savings/{id}/use', 'SavingsController@useFounds');
    Route::post('/savings/{id}/usedFounds', 'SavingsController@usedFounds');

    //Budget
    Route::resource('/budget', 'BudgetController');
    Route::post('/budget/savings-budget', 'BudgetController@storeSavingsBudget');

    //User Routes
    Route::resource('/user', 'UserController');
    Route::get('/user/{{username}}', 'UserController@show');

    //Dashboard
    Route::get('/dashboard', 'DashboardController@dashboard');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth.basic'], function() {
    //Categories routes
    Route::resource('/categories/earnings', 'EarningsCategoriesController');
    Route::resource('/categories/expenses', 'ExpensesCategoriesController');
    Route::post('/categories/expenses/{id}/reports', 'ReportsController@expensesCategoryReport');

    //Earnings
    Route::resource('/earnings', 'EarningsController');
    Route::post('/earnings/reports', 'ReportsController@earningsreport');

    //Expenses
    Route::resource('/expenses', 'ExpensesController');
    Route::post('/expenses/reports', 'ReportsController@expensesreport');

    //Savings
    Route::resource('/savings', 'SavingsController');
    Route::get('/savings/{id}/add', 'SavingsController@addFounds');
    Route::post('/savings/{id}/updateAmount', 'SavingsController@updateAmount');
    Route::get('/savings/{id}/use', 'SavingsController@useFounds');
    Route::post('/savings/{id}/usedFounds', 'SavingsController@usedFounds');

    //Budget
    Route::resource('/budget', 'BudgetController');
    Route::post('/budget/savings-budget', 'BudgetController@storeSavingsBudget');

    //User Routes
    Route::resource('/user', 'UserController');
    Route::get('/user/{{username}}', 'UserController@show');

    //Dashboard
    Route::get('/dashboard', 'DashboardController@dashboard');
});

//General Routes
Route::get('/', function() {
    return redirect('/auth/login');
});
Route::get('home', function() {
    return redirect('/dashboard');
});

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
