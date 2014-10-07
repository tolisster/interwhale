<?php

return array(

	// The default gateway to use
	'default' => 'paypal',

	// Add in each gateway here
	'gateways' => array(
		'paypal' => array(
			'driver' => '\\App\\Omnipay\\PayPal\\ExtendedExpressGateway',
			'options' => array(
				'solutionType' => '',
				'landingPage' => '',
				'headerImageUrl' => '',
				'brandName' => 'InterWhale - International Dating Service',
				'logoImageUrl' => 'http://www.interwhale.com/images/logo.png',
				'borderColor' => '3A8FC8',
				'username' => 'gribanovtim_api1.gmail.com',//'tolisster_api1.gmail.com'
				'password' => '22STNJGA94DJPWXW',//'RMJZFJ7YL5L3QQNA'
				'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AB1hinny9inCLbTskur.fQHjQKb5',//'AIn3zHT0yPxqi8t8ehJxluDDjuG.AiQYSpPKR2feCGc9WdvLNwTJxAId'
				'testMode' => false
			)
		)
	)
);