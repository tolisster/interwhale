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
				'brandName' => 'InterWhale - International Dating Service',
				'logoImageUrl' => 'http://www.interwhale.com/images/logo.png',
				'borderColor' => '3A8FC8',
				'username' => 'logicsoft_api1.logicsoft.md',//'gribanovtim_api1.gmail.com''tolisster_api1.gmail.com'
				'password' => 'NYQHPLH4EM8FGKPM',//'22STNJGA94DJPWXW''RMJZFJ7YL5L3QQNA'
				'signature' => 'ATyKrcceO7ARJUqLc3M3BVPXU1YFAZ8HYLpLcBLd0qouX5JT.pAjIKMk',//'AFcWxV21C7fd0v3bYYYRCpSSRl31AB1hinny9inCLbTskur.fQHjQKb5''AIn3zHT0yPxqi8t8ehJxluDDjuG.AiQYSpPKR2feCGc9WdvLNwTJxAId'
				'testMode' => false
			)
		),
		'skrill' => array(
			'driver' => 'Skrill',
			'options' => array(
				'email' => 'logicsoft@logicsoft.md',
				//'password' => '125QIH645',
				'notifyUrl' => URL::to('register/skrill/notify'),
				'testMode' => false
			),
			'requestOptions' => array(
				'language' => 'EN',
				'recipientDescription' => 'InterWhale - International Dating Service',
				//'logoUrl' => 'http://www.interwhale.com/images/logo.png',
			)
		)
	)
);