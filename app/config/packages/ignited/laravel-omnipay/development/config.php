<?php

return array(

	// The default gateway to use
	'default' => 'paypal',

	// Add in each gateway here
	'gateways' => array(
		'paypal' => array(
			'driver' => 'PayPal_Express',
			'options' => array(
				'solutionType' => '',
				'landingPage' => '',
				'headerImageUrl' => '',
				'brandName' => 'Test InterWhale - International Dating Service',
				'logoImageUrl' => 'http://www.interwhale.com/images/logo.png',
				'borderColor' => '3A8FC8',
				'username' => 'tolisster-facilitator_api1.gmail.com',
				'password' => 'C4KX683EECA7EEVY',
				'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AWOIS4xFkqTcLGzEwYynfXu1Bdyb',
				'testMode' => true
			)
		)
	)
);