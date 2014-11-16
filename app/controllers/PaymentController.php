<?php

class PaymentController extends BaseController {

	/**
	 * Register process payment.
	 */
	public function postRegister()
	{
		$ip = $this->getClientIp();

		$gateway = Input::get('gateway');
		Omnipay::setGateway($gateway);

		$purchaseOptions = array(
			'amount' => App::environment('production') ? 2.99 : 0.01,
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
	}

	public function getCancel($gateway)
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
	}

	private function generatePassword()
	{
		return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
	}

	private function welcomeSend($user, $password)
	{
		Mail::send('emails.welcome', array('user' => $user, 'password' => $password), function($message) use ($user)
		{
			$email = $user->email;
			if (preg_match('/tolisster-test\d+@gmail\.com/', $email))
				$email = 'tolisster@gmail.com';
			if ($email == 'gribanovtim-test@gmail.com')
				$email = 'gribanovtim@gmail.com';
			$message->to($email, $user->full_name)->subject('Welcome to InterWhale!');
		});
	}

	public function getReturn($gateway)
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

			$email = $data['EMAIL'];

			DB::update('UPDATE payments SET email = ?, first_name = ?, last_name = ?,
		country_code = ?, country_name = ?, state_code = ?, city = ?, note = ?,
		updated_at = NOW() WHERE token = ?',
				array(
					$email,
					$data['FIRSTNAME'],
					$data['LASTNAME'],
					$data['COUNTRYCODE'],
					$data['SHIPTOCOUNTRYNAME'],
					$data['COUNTRYCODE'] == 'US' ? $data['SHIPTOSTATE'] : null,
					$data['SHIPTOCITY'],
					isset($data['PAYMENTREQUEST_0_NOTETEXT']) ? $data['PAYMENTREQUEST_0_NOTETEXT'] : null,
					$data['TOKEN']
				));

			$user = User::firstOrNew(array('email' => $email));
			if (count($user->getOriginal()) == 0) {
				$password = $this->generatePassword();

				$ip = $this->getClientIp();

				$user->email = $email;
				$user->first_name = $data['FIRSTNAME'];
				$user->last_name = $data['LASTNAME'];
				$user->country_code = $data['COUNTRYCODE'];
				$user->state_code = $data['COUNTRYCODE'] == 'US' ? $data['SHIPTOSTATE'] : null;
				$user->city = $data['SHIPTOCITY'];
				$user->password = Hash::make($password);
				$user->ip_address = $ip;
				$user->subscription_ends_at = Carbon\Carbon::now()->addYear();
				$user->save();

				$userInfo = new UserInfo;
				$userInfo->status = isset($data['PAYMENTREQUEST_0_NOTETEXT']) ? $data['PAYMENTREQUEST_0_NOTETEXT'] : '';
				$user->userInfo()->save($userInfo);

				Log::info('user created', $user->toArray() + array('password' => $password));

				$this->welcomeSend($user, $password);
			} else {
				$user->subscription_ends_at = $user->subscription_ends_at->addYear();
				$user->save();
			}

			Auth::login($user);

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

			if (empty($payment->email)) {
				Log::error('Omnipay error', $results);
				return Redirect::route('home');
			}

			$ip = $this->getClientIp();

			$user = User::whereEmail($payment->email)->firstOrFail();
			$user->ip_address = $ip;
			$user->save();

			Auth::login($user);
		}

		return Redirect::to('profile/settings');
	}

	public function postNotify($gateway)
	{
		Log::info('Omnipay', array(Input::all()));
		if ($gateway == 'skrill') {
			$statusCallback = new \Omnipay\Skrill\Message\StatusCallback(Input::all());

			if (!$statusCallback->isSuccessful()) {
				Log::error('Omnipay error', array($statusCallback->getMessage()));
				return 'Ok';
			}

			$email = $statusCallback->getCustomerEmail();

			DB::update('UPDATE payments SET email = ?, amount = ?, currency = ?,
		updated_at = NOW(), canceled = ? WHERE id = ?',
				array(
					$email,
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

			$user = User::firstOrNew(array('email' => $email));
			if (count($user->getOriginal()) == 0) {
				$password = $this->generatePassword();

				$user->email = $email;
				$user->password = Hash::make($password);
				$user->subscription_ends_at = Carbon\Carbon::now()->addYear();
				$user->save();

				$userInfo = new UserInfo;
				$user->userInfo()->save($userInfo);

				Log::info('user created', $user->toArray() + array('password' => $password));

				$this->welcomeSend($user, $password);
			} else {
				$user->subscription_ends_at = $user->subscription_ends_at->addYear();
				$user->save();
			}
		}

		return 'Ok';
	}
}