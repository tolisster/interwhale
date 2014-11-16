<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::pattern('user', '[a-z][a-z0-9]{6}[0-9]');
Route::model('user', 'User');
Route::bind('user', function($value, $route)
{
	$user = User::where('code', $value)->first();
	if (is_null($user))
		App::abort(404);
	return $user;
});
Route::get('{user}', array('before' => 'auth', 'uses' => 'UserController@showProfile'))/*
	->where('code', '[A-Za-z0-9]+')*/;

Route::get('profile', array('as' => 'profile', 'before' => 'auth', 'uses' => 'UserController@showProfile'));
Route::get('profile/settings', array('as' => 'settings', 'before' => 'auth', 'uses' => 'UserController@settings'));
Route::get('profile/edit/{panel}', array('as' => 'profile.edit', 'before' => 'auth', 'uses' => 'UserController@editProfile'));
Route::post('profile/update/{panel}', array('as' => 'profile.update', 'before' => 'auth', 'uses' => 'UserController@updateProfile'));
Route::resource('friends', 'FriendController', array('only' => array('index', 'store')));
Route::resource('alerts', 'AlertController', array('only' => array('destroy')));

Route::get('chat/{user}', array('as' => 'chat', 'before' => 'auth', 'uses' => 'UserController@showChat'));
Route::post('chat/{user}', array('as' => 'chat', 'before' => 'auth', 'uses' => 'UserController@postChatMessage'));

Route::get('logout', array('as' => 'logout', 'before' => 'auth', function()
{
	Auth::logout();
	return Redirect::route('home');
}));

Route::post('register/{gateway}/notify', 'PaymentController@postNotify');
Route::get('register/{gateway}/return', 'PaymentController@getReturn');
Route::get('register/{gateway}/cancel', 'PaymentController@getCancel');

Route::get('search', array('as' => 'search', 'before' => 'auth', function()
{
	$searchQuery = Auth::user()->search_query;
	if (is_null($searchQuery)) {
		$searchQuery = new SearchQuery;
	} else {
		if (count(Input::all()) == 0) {
			$search = array_intersect_key($searchQuery->toArray(), array_flip($searchQuery->getFillable()));
			array_walk_recursive($search, function(&$item, $key) {
				$item = !is_null($item) ? $item : '';
			});
			return Redirect::route('search', $search);
		}
		$searchQuery->country_code = null;
		$searchQuery->gender = null;
		$searchQuery->from_age = null;
		$searchQuery->to_age = null;
		$searchQuery->relationship = null;
	}

	$users = User::filter(Input::instance(), $searchQuery)->paginate(15);

	$view = View::make('users')->with('users', $users);

	Auth::user()->searchQuery()->save($searchQuery);

	return $view;
}));

$supportedLocales = Config::get('app.supported_locales');
$locale = Request::segment(1);
if (in_array($locale, $supportedLocales)) {
	App::setLocale($locale);
} else {
	$locale = null;
}

Route::group(array('prefix' => $locale), function() {

	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getHome'));

	Route::get('{page}', 'HomeController@getPage');

	Route::controller('password', 'RemindersController');

});

Route::post('login', function()
{
	if (Auth::attempt(array(
		'email' => Input::get('email'),
		'password' => Input::get('password')
	), Input::has('remember'))) {

		$ip = $this->getClientIp();

		Auth::user()->ip_address = $ip;
		Auth::user()->save();

		return Redirect::intended('profile');
	}

	$errors = new Illuminate\Support\MessageBag(array('password' => array('Email and/or password invalid.')));
	return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
});

Route::post('register', 'PaymentController@postRegister');

Route::resource('photo', 'PhotoController', array('only' => array('create', 'store')));
Route::resource('avatar', 'AvatarController', array('only' => array('store')));

Route::when('imagecache/*', 'auth');