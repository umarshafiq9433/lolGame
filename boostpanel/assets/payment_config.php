<?php

// Paypal array
$paypal = array(
	'enabled' => true,
	'payment_url' => 'https://www.paypal.com/cgi-bin/webscr',
	'cmd' => '_xclick',
	'return' => 'https://smurfbuddy.com/',
	'currency_code' => 'USD',
	'business' => 'pay@smurfbuddy.com',
	'IPN' => 'https://smurfbuddy.com/boostpanel/listener.php'
);

// Skrill array
$skrill = array(
	'enabled'			=> true,
	'payment_url'		=> 'https://pay.skrill.com',
	'logo_url'			=> 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/assets/images/logo.png',
	'return_url'		=> 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/lolboosting',
	'cancel_url'		=> 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/lolboosting',
	'status_url'		=> 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/boostpanel/skrill-listener.php',
	'currency_code'		=> 'USD',
	'merchant_fields'	=> 'Field1,Field2',

	// ―― » Skrill merchant detail
	'merchant_email'	=> 'demoqco@sun-fish.com',
);

// G2A array
$g2a = array(
	'enabled' => true,
	// 'payment_url' => 'https://checkout.pay.g2a.com/index/createQuote',
	'payment_url' => 'https://checkout.test.pay.g2a.com/index/createQuote',
	'url_failure' => 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/lolboosting',
	'url_ok' => 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/lolboosting',
	'currency_code' => 'EUR',

	// ―― » G2A merchant detail
	'merchant_email'	=> 'udaniel91@gmail.com',
	'order_id'			=> '1', // ―― » Merchant order ID
	'api_hash'			=> 'd4fd4466-88ce-455b-b4a9-5301741779c1', // ―― » Store API Hash
	'secret'			=> 'A7q6-d7Ee-f-q^8HQ1O$o&Y%4X4%qI~Ph@D81Rm@bf+jwIj8DL6lHA5L5wd^k_', // ―― » Store Secret
	// 'hash'				=> 'ac0945d82b8589959b5f4ffafcc1a6c5983e82b8b4094c377a7b9c43d4a432bc', // ―― » Calculated hash
	'items'			=> [
		'id'		=> '11',
		'sku'		=> 'LB',
		'name'		=> 'LoL Boosting',
		'qty'		=> 1,
		'url'		=> 'https://'. $_SERVER[ 'HTTP_HOST' ] .'/lolboosting',
		'amount'	=> 10,
		'price'		=> 10,
	]
);
	// ―― » Calculated hash
	// $g2a[ 'hash' ] = hash( 'sha256', $g2a[ 'order_id' ] . $g2a[ 'merchant_email' ] . $g2a[ 'secret' ] );
	// $g2a[ 'hash' ] = hash( 'sha256', $g2a[ 'api_hash' ] . $g2a[ 'merchant_email' ] . $g2a[ 'secret' ] );
	$g2a[ 'hash' ] = hash( 'sha256', $g2a[ 'order_id' ] . 10 . $g2a[ 'currency_code' ] . $g2a[ 'secret' ] );
