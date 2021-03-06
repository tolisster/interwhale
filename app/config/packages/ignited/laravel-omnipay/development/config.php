<?php

return array(

	// The default gateway to use
	'default' => 'paypal',

	'gateways' => array(
		'paypal' => array(
			'driver' => '\\App\\Omnipay\\PayPal\\ExtendedExpressGateway',
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
		),
		'skrill' => array(
			'driver' => 'Skrill',
			'options' => array(
				'email' => 'logicsoft@logicsoft.md',//'skrilltest@logicsoft.md'
				//'password' => '125QIH645',
				'notifyUrl' => URL::to('register/skrill/notify'),
				'testMode' => true
			),
			'requestOptions' => array(
				'language' => 'EN',
				'recipientDescription' => 'Test InterWhale - International Dating Service',
				//'logoUrl' => 'http://www.interwhale.com/images/logo.png',
			)
		)
	)
);