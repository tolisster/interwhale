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

Route::get('users', array('before' => 'auth', function()
{
	$users = User::all();

	return View::make('users')->with('users', $users);
}));

Route::post('login', function()
{
	if (Auth::attempt(array(
		'email' => Input::get('email'),
		'password' => Input::get('password'),
		'active' => 1
	), Input::has('remember')))
	{
		return Redirect::intended('profile');
	}
});

Route::post('logout', array('before' => 'auth', function()
{
	Auth::logout();
}));

Route::pattern('user', '[A-Za-z0-9]+');

Route::model('user', 'User');

Route::bind('user', function($value, $route)
{
	$user = User::where('code', $value)->first();
	if ($user == null)
		App::abort(404);
	return $user;
});

Route::get('{user}', array('before' => 'auth', function(User $user = null)
{
	return View::make('user')->with('user', $user);
}))/*
	->where('code', '[A-Za-z0-9]+')*/;

Route::get('profile', array('before' => 'auth', function()
{

	return View::make('user')->with('user', $user);
}));

Route::post('register', array('before' => 'csrf', function()
{
	return 'You gave a valid CSRF token!';
}));

Route::controller('password', 'RemindersController');