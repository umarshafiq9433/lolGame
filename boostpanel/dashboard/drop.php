<?php 
	
	require '../assets/class/init.php';
	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->booster();

	$id = $_GET['id'];
	$bid = $_GET['bid']; 

	$req = $db->prepare("UPDATE orders SET booster_id = ?, order_status = ? WHERE order_id = ? AND booster_id = ?");
	$req->execute(array("0", "Looking for booster", $id, $bid));
	
	$req1 = $db->prepare("DELETE FROM livechat WHERE id = ?");
	$req1->execute(array($id));

	$_SESSION['drop'] = 1;
	echo "<script>window.location='index.php'</script>";
	//header("Location: index.php");


?>