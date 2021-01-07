<?php 

	require '../assets/class/init.php';

	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->dashboard();

	$id = $_GET['id'];

	$req = $db->prepare("UPDATE orders SET booster_payed = ? WHERE booster_id = ?");
	$req->execute(array("1", $id));
	$_SESSION['payed'] = 1;
	//header("Location: index.php");
echo "<script>window.location='index.php'</script>";

?>