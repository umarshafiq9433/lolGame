<?php

ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

if ( !$_POST ) exit;

require 'assets/class/Database.php';
$site_owners_name = 'SmurfBuddy';


if ( $_POST[ 'status' ] == 2 || $_POST[ 'status' ] == 0 ) {

	// Create random Orer ID
	function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

	// ―― » Debug
	// $File = 'debugLog.txt';
	// $Handle = fopen( $File, 'w' );
	// fwrite( $Handle, json_encode( $_POST ) );
	// fclose( $Handle );

		// assign posted variables to local variables
		$item_name = $_POST[ 'Field2' ]; // Boost order
		$payment_status = $_POST[ 'status' ]; // Status of the payment
		$payment_amount = $_POST[ 'amount' ]; // Price
		$custom = $_POST[ 'Field1' ]; // Get Everything

		// Explode custom
		$res = explode('|', $custom);
		$boost = $res[0];
		$wins = $res[1]; // Number of wins (Net Wins / Placement)
		$type = $res[2]; // Solo / Duo
		$server = $res[3]; // Euw etc..
		$lolaccount = $res[4]; // Lol account
		$lolpassword = $res[5]; // Lol password
		$lolsummoner = $res[6]; // Lol summoner
		$queue = $res[7]; // Solo/Duo (5v5)
		$flashE = explode('_', $res[8]); // Flash D, F
		$flash = $flashE[1];
		$email = $res[9];
		$notes = $res[10];

		// Explode item_name
		if ($boost == "Division") {
			$re = explode(' ', $item_name);
			$current_league = $re[0]; // Current league
			$current_division = $re[1]; // Current division
			$desired_league = $re[3]; // Current division
			$desired_division = $re[4]; // Current division
		} else if ($boost == "Placement") {
			$re = explode(' ', $item_name);
			$current_league = $re[0]; // Current league
			$current_division = null; // Current division
			$desired_league = null; // Current division
			$desired_division = null; // Current division
		} else if ($boost == "Net Wins") {
			$re = explode(' ', $item_name);
			$current_league = $re[0]; // Current league
			$current_division = $re[1]; // Current division
			$desired_league = null; // Current division
			$desired_division = null; // Current division
		}


		// Start
		$order_id = randomString( 5 ); // Order ID


		// Include Website name
		require 'assets/class/Website.php';
		$wb = new Website();
		$website = $wb->getName();

	// Check if user haven't already registrated an email,
	// if not ; send him details of his logins, if yes, just send him order details
	$exUser = $db->prepare( "SELECT email FROM users WHERE email = ?" );
	$exUser->execute( array( $email ) );
	$exUser = $exUser->fetch();

	// If user exist
	if( $exUser != false ) {
		// Change order_id if user exist
		$orderChange = $db->prepare( "UPDATE users SET order_id = ? WHERE email = ?" );
		$orderChange->execute( array( $order_id, $email ) );

		// Send mail with details
		mail(
			$email,
			$website . " - Order " .$order_id,
			"Hello, thank you for placing the order. You can see the details of your order below!
			\n
Your order : ".$item_name."
Price : ".$payment_amount." €
\n
You can track your order using our website. Use your login credentials to log into your customer area. If you have any questions, contact us via our Live Chat.
\n
You can login to the Boosting Panel here:
https://smurfbuddy.com/boostpanel/login.php
\n
Best regards,

".$site_owners_name."
"
		);

	} else { // If user don't exist
		$password = randomString( 7 ); // Generate password
		$username = substr( $email, 0, strpos( $email, '@' ) ); // Generate username

		// Add user to database
		$user = $db->prepare( "INSERT INTO users SET username = ?, email = ?, password = ?, order_id = ?" );
		$user->execute(array(ucfirst($username), $email, hash('SHA512', $password), $order_id));

		// Send email with details
		mail(
			$email,
			$website . " - Order " .$order_id,
			"Hello, thank you for placing the order. You can see the details of your order below!
			\n
Your order : ".$item_name."
Price : ".$payment_amount." €
			\n
************************************************************
			\n
Username : ".$email."
Password : ".$password."
			\n
************************************************************
			\n
You can track your order using our website. Use your login credentials to log into your customer area. If you have any questions, contact us via our Live Chat.
\n
You can login to the Boosting Panel here:
https://smurfbuddy.com/boostpanel/login.php
\n
Best regards,

".$site_owners_name.""
		);
	}

	// Add order
	// Get ID of user
	$userID = $db->prepare( "SELECT id FROM users WHERE email = ?" );
	$userID->execute( array( $email ) );
	$userID = $userID->fetch();

	// Add Order
	$order = $db->prepare("
		INSERT INTO
		orders
		SET order_id = ?, lol_account = ?, lol_password = ?, lol_summoner = ?, lol_server = ?, start_league = ?, start_division = ?, current_league = ?, current_division = ?, desired_league = ?, desired_division = ?, order_queue = ?, order_boost = ?, order_wins = ?, order_type = ?, order_notes = ?, order_price = ?, user_id = ?");
	$order->execute( array( $order_id, $lolaccount, $lolpassword, $lolsummoner, $server, $current_league, $current_division, $current_league, $current_division, $desired_league, $desired_division, $queue, $boost, $wins, $type, $notes, $payment_amount, $userID['id'] ) );

	// Add flash
	$flashOpt = $db->prepare( "INSERT INTO options SET order_id = ?, flash = ?" );
	$flashOpt->execute( array( $order_id, $flash ) );


$req = $db->query("SELECT email,type FROM users WHERE type='admin' OR type='booster'");
		$boosters = $req->fetchAll();

		$subject = 'A new order has been placed on '.$site_owners_name;

	foreach($boosters as $boostersdata) {
		$email =  $boostersdata['email'];
		$type =  $boostersdata['type'];

		if( $type == 'admin' )
		{

		$lurl = 'https://smurfbuddy.com/boostpanel/login.php';
$message_body = '
Dear Admin!


A new Order is available in our System!


You can login to the Boosting Panel here:
'.$lurl.'


Order Details:

ID : '.$order_id.'
Queue : '.$queue.'
Boost : '.$boost.' - '.$current_league.' '.$current_division.' -> '.$desired_league.' '.$desired_division.'
Type : '.$type.'
Server : '.$server.'
Date : '.date("d/m/Y").'
Price : '.$payment_amount.'€




Best regards,

'.$site_owners_name.'

';


		 mail(
			$email,
			$subject,
			$message_body
		);

		}
		else
		{
			$req1 = $db->query("SELECT percentage FROM boosters WHERE email='$email'");
		$bdd = $req1->fetch();
		$percentage = $bdd['percentage'];
		$namount = number_format($percentage * $payment_amount / 100, 2, '.', '');

		$lurl = "https://smurfbuddy.com/boostpanel/login.php";
$message_body = '
Dear Booster!


A new Order is available in our System!


You can login to the Boosting Panel here:
'.$lurl.'


Order Details:

ID : '.$order_id.'
Queue : '.$queue.'
Boost : '.$boost.' - '.$current_league.' '.$current_division.' -> '.$desired_league.' '.$desired_division.'
Type : '.$type.'
Server : '.$server.'
Date : '.date("d/m/Y").'
Your Cut : '.$namount.'€




Best regards,

'.$site_owners_name.'

';


		 mail(
			$email,
			$subject,
			$message_body
		);

		}


	}



}

