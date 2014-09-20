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

Route::get('profile', array('as' => 'profile', 'before' => 'auth', function()
{
	$user = Auth::user();
	return View::make('user')->with('user', $user);
}));

Route::get('logout', array('as' => 'logout', 'before' => 'auth', function()
{
	Auth::logout();
	return Redirect::route('home');
}));

Route::get('register/return', function()
{
	$response = Omnipay::completePurchase(array(
		'amount' => 2.99,
		'currency' => 'USD',
		'returnUrl' => URL::to('register/return'),
		'cancelUrl' => URL::to('register/cancel')
	))->send();
	$data = $response->getData();
	Log::info('Omnipay complete purchase', $data);

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
			$data['SHIPTOSTATE'],
			$data['SHIPTOCITY'],
			isset($data['PAYMENTREQUEST_0_NOTETEXT']) ? $data['PAYMENTREQUEST_0_NOTETEXT'] : null,
			$data['TOKEN']
		));

	$password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

	$user = new User;
	$user->email = $data['EMAIL'];
	$user->first_name = $data['FIRSTNAME'];
	$user->last_name = $data['LASTNAME'];
	$user->country_code = $data['COUNTRYCODE'];
	$user->country_name = $data['SHIPTOCOUNTRYNAME'];
	$user->state_code = $data['SHIPTOSTATE'];
	$user->city = $data['SHIPTOCITY'];
	$user->password = Hash::make($password);
	$user->save();

	DB::update("UPDATE users SET code = concat(
              substring('abcdefghijklmnopqrstuvwxyz', rand(@seed:=round(rand(?)*4294967296))*26+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed:=round(rand(@seed)*4294967296))*36+1, 1),
              substring('abcdefghijklmnopqrstuvwxyz0123456789', rand(@seed)*36+1, 1)
             ), active = 1
     WHERE id = ?", array($user->id, $user->id));

	Log::info('user created', array_merge($user->toArray(), array('password' => $password)));

	Auth::login($user);

	return Redirect::route('profile');
});

Route::get('register/cancel', function()
{
	Log::info('Omnipay canceled', array(Input::get('token')));

	DB::update('UPDATE payments SET canceled = 1, updated_at = NOW() WHERE token = ?',
		array(
			Input::get('token')
		));

	return Redirect::route('home');
});

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

Route::post('pay_via_paypal', 'PaymentController@postPayment');
Route::get('payment_success', 'PaymentController@getSuccessPayment');
Route::get('cancel_order', function() {
	return Redirect::route('home');
});

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
		return Redirect::intended('profile');
	$errors = new Illuminate\Support\MessageBag(['password' => ['Email and/or password invalid.']]);
	return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
});

Route::post('register', array('before' => 'csrf', function()
{
	$response = Omnipay::purchase(array(
		'amount' => 2.99,
		'currency' => 'USD',
		'returnUrl' => URL::to('register/return'),
		'cancelUrl' => URL::to('register/cancel')
	))->send();
	$data = $response->getData();
	Log::info('Omnipay purchase', $data);
	DB::insert('INSERT INTO payments (token, created_at, updated_at) values (?, NOW(), NOW())', array($data['TOKEN']));
	if ($response->isSuccessful()) {
// payment was successful: update database
		//print_r($response);
		Log::info('Omnipay successful', $data);
	} elseif ($response->isRedirect()) {
// redirect to offsite payment gateway
		$response->redirect();

	} else {

// payment failed: display message to customer
		echo $response->getMessage();

	}
}));
