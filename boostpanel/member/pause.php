<?php 

require '../assets/class/init.php';

	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->member();
	// Orders
	$order = new Order();
	$order = $order->getOrder();
	
	if($_REQUEST['id']!="")
	{
	    $order_id = $_REQUEST['id'];
	    $order_status = $_REQUEST['status'];
	    $req = $db->prepare("UPDATE orders SET order_pause = ? WHERE order_id = ?"); 
	 if($order_status === "Pause")
	{ 
	    $req->execute(array("Resume", $order_id));
		$_SESSION['Resume'] = 1;
	}else{ 
	    $req->execute(array("Pause", $order_id));
		$_SESSION['Pause'] = 1;
	}
	}
	else 
	{

	// Pause order / or continue
	$req = $db->prepare("UPDATE orders SET order_pause = ? WHERE user_id = ?");
	if($order['order_pause'] === "Pause")
	{
		$req->execute(array("Resume", $_SESSION['id']));
		$_SESSION['Resume'] = 1;
	}else{
		$req->execute(array("Pause", $_SESSION['id']));
		$_SESSION['Pause'] = 1;
	}
	}
	echo "<script>window.location='index.php'</script>";
	//header("Location: index.php");
?>