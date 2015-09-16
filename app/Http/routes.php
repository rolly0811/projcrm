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

//MENU: Company Management
Route::any('/company_management', 'CompanyManagementController@showCompanyManagement');
Route::any('/company_management/edit/{manager_idx}', 'CompanyManagementController@showCompanyManagement_EDIT');
Route::any('/company_management/add', 'CompanyManagementController@showCompanyManagement_ADD');

Route::any('/company_management/account/add/{manager_idx}', 'CompanyManagementController@showAccount_ADD');
Route::any('/company_management/transaction/add/{manager_account_id}', 'CompanyManagementController@showTransaction_ADD');

Route::any('/company/add', 'CompanyController@showCompany_ADD');

//MENU: RING GROUP
Route::any('/ringgroup/add', 'RinggroupController@add');

//MENU: Manage Users
Route::any('/manage_users', 'ManageUsersController@showManageUsers');


//VALIDATION
Route::any('/check/company', 'CompanyManagementController@validate_company');
Route::post('/check/manager', 'CompanyManagementController@validate_manager');
Route::post('/check/manager/sample', 'CompanyManagementController@validate_manager_sample');

Route::any('/ringgroups', 'RinggroupController@show');
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