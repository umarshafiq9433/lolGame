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

	$req = $db->prepare("SELECT users.avatar, users.type, users.username, livechat.message, DATE_FORMAT(livechat.date, '%d/%m %H:%i') AS date 
		FROM livechat 
		INNER JOIN users 
		ON users.id = livechat.user_id
		WHERE livechat.order_id = ?
		ORDER BY livechat.id");
	$req->execute(array($order_id));
	
	while($message = $req->fetch(PDO::FETCH_ASSOC))
	{
		if($message['type'] === 'member')
		{
			echo '<div class="direct-chat-msg">
											<div class="direct-chat-info clearfix">
												<span class="direct-chat-name pull-left">'.$message['username'].'</span>
												<span class="direct-chat-timestamp pull-right">'.$message['date'].'</span>
											</div>
											<img class="direct-chat-img" src="../assets/img/avatars/'.$message['avatar'].'" alt="Message user Image">
											<div class="direct-chat-text">
												'.$message['message'].'
											</div>
										</div>';
		}else{
			echo '<div class="direct-chat-msg right">
											<div class="direct-chat-info clearfix">
												<span class="direct-chat-name pull-right">'.$message['username'].'</span>
												<span class="direct-chat-timestamp pull-left">'.$message['date'].'</span>
											</div>
											<img class="direct-chat-img" src="../assets/img/avatars/'.$message['avatar'].'" alt="Message user Image">
											<div class="direct-chat-text">
												'.$message['message'].'
											</div>
										</div>';
		}
	}



?>