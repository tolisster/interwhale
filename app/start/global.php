<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*App::error(function(HttpExceptionInterface $exception, $code)
{
	Log::error($exception);
	if (Request::wantsJson()) {
		return Response::json(array(
			'error' => true,
			'message' => $exception->getMessage(),
			'code' => $code),
			$code
		);
	}
});*/

App::missing(function($exception)
{
	return Response::view('errors.missing', array(), 404);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::view('maintenance', array(), 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

User::created(function($user)
{
	DB::update("update users set code = concat(
			substring('abcdefghijklmnopqrstuvwxyz', rand(@seed:=round(rand(?)*4294967296))*26+1, 1),
			substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
			substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
			substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
			substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
			substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
			substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
			substring('0123456789', rand(@seed)*10+1, 1)
			) where id = ?", array($user->id, $user->id));
});

Form::macro('selectWithDefault', function($name, $list, $selected = null, $default = null, $attributes = array())
{
	return Form::select($name, $default + $list, $selected, $attributes);
});

Form::macro('selectRangeWithDefault', function($name, $begin, $end, $selected = null, $default = null, $options = array())
{
	$range = array_combine($range = range($begin, $end), $range);

	return Form::selectWithDefault($name, $range, $selected, $default, $options);
});

Form::macro('selectYearWithDefault', function($name, $begin, $end, $selected = null, $default = null, $options = array())
{
	return Form::selectRangeWithDefault($name, $begin, $end, $selected, $default, $options);
});

Form::macro('selectMonthWithDefault', function($name, $selected = null, $default = null, $options = array(), $format = '%B')
{
	$months = array();

	foreach (range(1, 12) as $month)
	{
		$months[$month] = strftime($format, mktime(0, 0, 0, $month, 1));
	}

	return Form::selectWithDefault($name, $months, $selected, $default, $options);
});
