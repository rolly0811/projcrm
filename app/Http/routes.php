<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/login', 'LoginController@showLogin');
Route::any('/logout', 'LoginController@showLogout');

Route::any('/user', 'UserController@showUser');
Route::any('/dashboard', 'DashboardController@showDashboard');

Route::any('/company_management', 'CompanyManagementController@showCompanyManagement');
Route::any('/company_management/edit/{manager_idx}', 'CompanyManagementController@showCompanyManagement_EDIT');
Route::any('/company_management/add', 'CompanyManagementController@showCompanyManagement_ADD');

Route::any('/company/add', 'CompanyController@showCompany_ADD');

//VALIDATION
Route::any('/check/company', 'CompanyManagementController@validate_company');
Route::post('/check/manager', 'CompanyManagementController@validate_manager');

//Added By Rolly
Route::any('/ringgroup', 'RinggroupController@show');
Route::post('/ringgroup/add', 'RinggroupController@add');

Route::any('/ringgroup/edit/{id}', 'RinggroupController@edit');
Route::any('/ringgroup/cancel/{id}', 'RinggroupController@cancel');
Route::post('/ringgroup/update/{id}', 'RinggroupController@update');
Route::any('/ringgroup/delete/{id}', 'RinggroupController@delete');
/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/