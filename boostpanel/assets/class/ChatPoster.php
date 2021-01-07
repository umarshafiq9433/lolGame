<?php 
	
	session_start();
	require 'Database.php';
	require 'classOrder.php';
	$order = new Order();
	if($_SESSION['type'] === 'member')
	{
		$order = $order->getOrder();
		
		if(isset($_REQUEST['order_id']) && $_REQUEST['order_id']!="")
	    {
	        $order_id = $_REQUEST['order_id'];
	    }
	    else
	    {
		$order_id = $order['order_id'];
	    }
	    
	}else{
		$order_id = $_SESSION['order_id'];
	}

	$req = $db->prepare("INSERT INTO livechat SET order_id = ?, user_id = ?, message = ?");
	$req->execute(array($order_id, $_SESSION['id'], $_POST['message']));
?>