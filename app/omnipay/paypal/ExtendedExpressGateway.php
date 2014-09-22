<?php

namespace App\Omnipay\PayPal;

use Omnipay\PayPal\ExpressGateway;

/**
 * PayPal Express extended Class
 */
class ExtendedExpressGateway extends ExpressGateway
{
	public function getName()
	{
		return 'PayPal Express extended';
	}

	public function fetchExpressCheckoutDetail(array $parameters = array())
	{
		return $this->createRequest('\\App\\Omnipay\\PayPal\\Message\\FetchExpressCheckoutRequest', $parameters);
	}
}
