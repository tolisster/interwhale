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

Route::post('register/{gateway}/notify', function($gateway)
{
	Log::info('Omnipay', array(Input::all()));
	if ($gateway == 'skrill') {
		$statusCallback = new \Omnipay\Skrill\Message\StatusCallback(Input::all());

		if (!$statusCallback->isSuccessful()) {
			Log::error('Omnipay error', array($statusCallback->getMessage()));
			return 'Ok';
		}

		DB::update('UPDATE payments SET email = ?, amount = ?, currency = ?,
		updated_at = NOW(), canceled = ? WHERE id = ?',
			array(
				$statusCallback->getCustomerEmail(),
				$statusCallback->getAmount(),
				$statusCallback->getCurrency(),
				$statusCallback->getStatus() == -1 ? 1 : 0,
				$statusCallback->getTransactionId()
			));

		if ($statusCallback->getStatus() == -1) {
			Log::info('Omnipay canceled', array(Input::all()));
			return 'Ok';
		}

		Log::info('Omnipay complete purchase', Input::all());

		$password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

		$user = new User;
		$user->email = $statusCallback->getCustomerEmail();
		$user->password = Hash::make($password);
		$user->save();

		$userInfo = new UserInfo;
		$user->userInfo()->save($userInfo);

		Log::info('user created', $user->toArray() + array('password' => $password));

		Mail::send('emails.welcome', array('password' => $password, 'user' => $user), function($message) use ($user)
		{
			$email = $user->email;
			if (preg_match('/tolisster-test\d+@gmail\.com/', $email))
				$email = 'tolisster@gmail.com';
			if ($email == 'gribanovtim-test@gmail.com')
				$email = 'gribanovtim@gmail.com';
			$message->to($email, $user->full_name)->subject('Welcome to InterWhale!');
		});
	}

	return 'Ok';
});

Route::get('register/{gateway}/return', function($gateway)
{
	Log::info('Omnipay', array(Input::all()));

	if ($gateway == 'paypal') {
		$response = Omnipay::completePurchase(array(
			'amount' => 2.99,
			'currency' => 'USD',
			'returnUrl' => URL::to("register/{$gateway}/return"),
			'cancelUrl' => URL::to("register/{$gateway}/cancel")
		))->send();
		$data = $response->getData();
		Log::info('Omnipay complete purchase', $data);

		if (!$response->isSuccessful()) {
			Log::error('Omnipay error', array($response->getMessage()));
			App::abort(500);
		}

		DB::update('UPDATE payments SET amount = ?, currency = ?, fee = ?,
		updated_at = NOW() WHERE token = ?',
			array(
				$data['PAYMENTINFO_0_AMT'],
				$data['PAYMENTINFO_0_CURRENCYCODE'],
				$data['PAYMENTINFO_0_FEEAMT'],
				Input::get('token')
			));

		$response = Omnipay::fetchExpressCheckoutDetail(array(
			'transactionReference' => $data['TOKEN']
		));
		$data = $response->getData();
		Log::info('Omnipay fetch detail', $data);
		DB::update('UPDATE payments SET email = ?, first_name = ?, last_name = ?,
		country_code = ?, country_name = ?, state_code = ?, city = ?, note = ?,
		updated_at = NOW() WHERE token = ?',
			array(
				$data['EMAIL'],
				$data['FIRSTNAME'],
				$data['LASTNAME'],
				$data['COUNTRYCODE'],
				$data['SHIPTOCOUNTRYNAME'],
				$data['COUNTRYCODE'] == 'US' ? $data['SHIPTOSTATE'] : null,
				$data['SHIPTOCITY'],
				isset($data['PAYMENTREQUEST_0_NOTETEXT']) ? $data['PAYMENTREQUEST_0_NOTETEXT'] : null,
				$data['TOKEN']
			));

		$password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

		$request = Request::instance();
		$request->setTrustedProxies(array('127.4.98.1')); // only trust proxy headers coming from the IP addresses on the array
		$ip = $request->getClientIp();

		$user = new User;
		$user->email = $data['EMAIL'];
		$user->first_name = $data['FIRSTNAME'];
		$user->last_name = $data['LASTNAME'];
		$user->country_code = $data['COUNTRYCODE'];
		$user->state_code = $data['COUNTRYCODE'] == 'US' ? $data['SHIPTOSTATE'] : null;
		$user->city = $data['SHIPTOCITY'];
		$user->password = Hash::make($password);
		$user->ip_address = $ip;
		$user->save();

		$userInfo = new UserInfo;
		$userInfo->status = isset($data['PAYMENTREQUEST_0_NOTETEXT']) ? $data['PAYMENTREQUEST_0_NOTETEXT'] : '';
		$user->userInfo()->save($userInfo);

		Log::info('user created', $user->toArray() + array('password' => $password));

		Auth::login($user);

		Mail::send('emails.welcome', array('password' => $password, 'user' => $user), function($message) use ($user)
		{
			$email = $user->email;
			if (preg_match('/tolisster-test\d+@gmail\.com/', $email))
				$email = 'tolisster@gmail.com';
			if ($email == 'gribanovtim-test@gmail.com')
				$email = 'gribanovtim@gmail.com';
			$message->to($email, $user->full_name)->subject('Welcome to InterWhale!');
		});
	} elseif ($gateway == 'skrill') {
		if (!Session::has('transactionId')) {
			Log::error('Omnipay error', Session::all());
			App::abort(500);
		}
		$transactionId = Session::get('transactionId');
		DB::update('UPDATE payments SET updated_at = NOW() WHERE id = ?',
			array(
				$transactionId
			));

		$results = DB::select('select * from payments where id = ?', array($transactionId));
		if (count($results) != 1) {
			Log::error('Omnipay error', $results);
			return Redirect::route('home');
		}
		$payment = $results[0];

		$request = Request::instance();
		$request->setTrustedProxies(array('127.4.98.1')); // only trust proxy headers coming from the IP addresses on the array
		$ip = $request->getClientIp();

		$user = User::whereEmail($payment->email);
		$user->ip_address = $ip;
		$user->save();

		Auth::login($user);
	}

	return Redirect::intended('profile');
});

Route::get('register/{gateway}/cancel', function($gateway)
{
	if ($gateway == 'paypal') {
		Log::info('Omnipay canceled', Input::all());
		DB::update('UPDATE payments SET canceled = 1, updated_at = NOW() WHERE token = ?',
			array(
				Input::get('token')
			));
	} elseif ($gateway == 'skrill') {
		Log::info('Omnipay canceled', Session::all());
		if (!Session::has('transactionId')) {
			Log::error('Omnipay error', Session::all());
			App::abort(500);
		}
		$transactionId = Session::get('transactionId');
		DB::update('UPDATE payments SET canceled = 1, updated_at = NOW() WHERE id = ?',
			array(
				$transactionId
			));
	}

	return Redirect::route('home');
});

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

		$request = Request::instance();
		$request->setTrustedProxies(array('127.4.98.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
		$ip = $request->getClientIp();

		Auth::user()->ip_address = $ip;
		Auth::user()->save();

		return Redirect::intended('profile');
	}

	$errors = new Illuminate\Support\MessageBag(array('password' => array('Email and/or password invalid.')));
	return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
});

Route::post('register', array(function()
{
	$request = Request::instance();
	$request->setTrustedProxies(array('127.4.98.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
	$ip = $request->getClientIp();

	$gateway = Input::get('gateway');
	Omnipay::setGateway($gateway);

	$purchaseOptions = array(
		'amount' => /*App::environment('production') ? 2.99 : */0.01,
		'currency' => 'USD',
		'returnUrl' => URL::to("register/{$gateway}/return"),
		'cancelUrl' => URL::to("register/{$gateway}/cancel")
	);
	if ($gateway == 'skrill') {
		$config = Config::get("ignited/laravel-omnipay::gateways.{$gateway}.requestOptions");
		foreach($config as $optionName => $value) {
			$purchaseOptions[$optionName] = $value;
		}
		$purchaseOptions['details'] = array('Sign Up' => 'Registration at the InterWhale');
		DB::insert('INSERT INTO payments (created_at, updated_at, ip_address) values (NOW(), NOW(), ?)',
			array(inet_pton($ip)));
		$transactionId = DB::getPdo()->lastInsertId();
		$purchaseOptions['transactionId'] = $transactionId;
		Session::flash('transactionId', $transactionId);
	}

	$response = Omnipay::purchase($purchaseOptions)->send();

	$data = $response->getData();
	if ($response->isSuccessful()) {
		// payment was successful: update database
		Log::info('Omnipay successful', (array) $data);
	} elseif ($response->isRedirect()) {
		// redirect to offsite payment gateway
		if ($gateway == 'paypal') {
			DB::insert('INSERT INTO payments (token, created_at, updated_at, ip_address) values (?, NOW(), NOW(), ?)',
				array($response->getTransactionReference(), inet_pton($ip)));
		}

		$url = $response->getRedirectUrl();
		return Redirect::to($url);
	} else {
		// payment failed: display message to customer
		echo $response->getMessage();
	}
}));

Route::resource('photo', 'PhotoController', array('only' => array('create', 'store')));
Route::resource('avatar', 'AvatarController', array('only' => array('store')));

Route::when('imagecache/*', 'auth');