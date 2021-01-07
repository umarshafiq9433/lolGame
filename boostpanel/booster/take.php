<?php 

	require '../assets/class/init.php';
	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->booster();

	$id = $_GET['id'];
$site_owners_name = 'EloBoostKing';
	$req = $db->prepare("UPDATE orders SET booster_id = ?, order_status = ? WHERE order_id = ?");
	$req->execute(array($_SESSION['id'], "In progress", $id));
 
	$req1 = $db->query("SELECT t2.email,t1.order_queue,t1.order_boost,t1.start_league ,t1.start_division ,t1.desired_league ,t1.desired_division ,t1.order_type ,t1.lol_server, t1.order_date, t1.order_price  FROM orders as t1 LEFT JOIN users as t2 ON t2.id = t1.user_id WHERE t1.order_id='$id'");
		$bdd = $req1->fetch();
	 $email =  $bdd['email'];
		
	$lurl = "https://eloboostking.com/boostpanel/login.php";
$message_body = '
Dear Customer!
      
      
Your order has been accepted and started. Please login and coordinate your order with the assigned Booster!
      
      
You can login to the Boosting Panel here:
'.$lurl.'
      
      
Order Details:
      
ID : '.$id.'
Queue : '.$bdd['order_queue'].'
Boost : '.$bdd['order_boost'].' - '.$bdd['start_league'].' '.$bdd['start_division'].' -> '.$bdd['desired_league'].' '.$bdd['desired_division'].'
Type : '.$bdd['order_type'].'
Server : '.$bdd['lol_server'].'
Date : '.date("d/m/Y",strtotime($bdd['order_date'])).'
Price : '.$bdd['order_price'].'€ 
	  
	  
	  
	  
Best regards,

'.$site_owners_name.'

';
	
	 // Send mail with details
        mail(
            $email,
            "Your order has been started on ".$site_owners_name."!",
            $message_body
            );
	$_SESSION['booster'] = 1;
	echo "<script>window.location='index.php'</script>";
//	header("Location: index.php");
?>