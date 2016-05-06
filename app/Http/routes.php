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

Route::group(['middleware' => 'web'], function () {
	//Show Schedule Dashboard
	Route::get('/', 'ProgramController@show');
	//Add New Program
	Route::post('/program', 'ProgramController@store');
	//Delete Program
	Route::delete('/program/{program}', 'ProgramController@delete');
	//Update Program
	Route::put('/program/{program}', 'ProgramController@update');
	//Show All Schedule in JSON Format
	Route::get('/json', 'ProgramController@all');
	//Show Schedule per Day in JSON Format
	Route::get('/json/monday', 'ProgramController@monday');
	Route::get('/json/tuesday', 'ProgramController@tuesday');
	Route::get('/json/wednesday', 'ProgramController@wednesday');
	Route::get('/json/thursday', 'ProgramController@thursday');
	Route::get('/json/friday', 'ProgramController@friday');
	Route::get('/json/saturday', 'ProgramController@saturday');
	Route::get('/json/sunday', 'ProgramController@sunday');

	//Show Users Dashboard
	Route::get('/users', ['as' => 'users', 'uses' => 'UserController@show']);
	//Add New User
	Route::post('/users/user', 'UserController@store');
	//Delete User
	Route::delete('/users/user/{user}', 'UserController@delete');
	//Update User
	Route::put('/users/user/{user}', 'UserController@update');
	//Show All Users in JSON Format
	Route::get('/users/json', 'UserController@all');
	//User Login
	Route::get('/login', 'UserController@login');

	//Show All Notifications in JSON Format
	Route::get('/notifications', 'NotificationController@all');

	//Show Emails Dashboard
	Route::get('/emails', ['as' =>'emails', 'uses' => 'EmailController@show']);
	//Delete Email
	Route::delete('/emails/email/{email}', 'EmailController@delete');
	//Update Email
	Route::put('/emails/email/{email}', 'EmailController@update');
	//Show All Emails in JSON Format
	Route::get('/emails/json', 'EmailController@all');
});

//Add New Notification
Route::post('/notification', 'NotificationController@store');

//Add New Email
Route::post('/email', 'EmailController@store');