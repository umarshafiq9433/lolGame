<?php 

	require '../assets/class/init.php';
	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->booster();

	$id = $_GET['id']; 

	$req = $db->prepare("UPDATE orders SET order_status = ? WHERE order_id = ? AND booster_id = ?");
	$req->execute(array("Finished", $id, $_SESSION['id']));

	$_SESSION['finished'] = 1;
//	header("Location: index.php");
echo "<script>window.location='index.php'</script>";

?>