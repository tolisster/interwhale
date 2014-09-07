<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getHome');
/*Route::get('/', function()
{
	return View::make('hello');
});*/

/*Route::get('users', 'UserController@getIndex');

Route::get('users', function()
{
	return View::make('users');
});*/

Route::get('users', function()
{
	$users = User::all();

	return View::make('users')->with('users', $users);
});

Route::post('log-in', function()
{
	return 'Hello!';
});

Route::pattern('user', '[A-Za-z0-9]+');

Route::model('user', 'User', function()
{
	var_dump(this);
	exit();
	throw new NotFoundHttpException;
});

Route::bind('user', function($value, $route)
{
	return User::where('code', $value)->first();
});

Route::get('{user}', function(User $user = null)
{
	return View::make('user')->with('user', $user);
})/*
	->where('code', '[A-Za-z0-9]+')*/;