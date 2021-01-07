<?php 
	require '../assets/class/init.php';

	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->dashboard();

	// Delete Booster
	$email = $_GET['email'];

	require '../assets/class/Database.php'; // Access to database
	$id = $db->prepare("SELECT id FROM users WHERE email = ?");
	$id->execute(array($email));
	$id = $id->fetch();
	var_dump($id[0]);

	$req = $db->prepare("DELETE FROM users WHERE email = ?");
	$req->execute(array($email));
	$req2 = $db->prepare("DELETE FROM boosters WHERE email = ?");
	$req2->execute(array($email));

	// Remove orders where booster was assigned
	$req3 = $db->prepare("UPDATE orders SET booster_id = '0', order_status = 'Looking for booster' WHERE booster_id = ?");
	$req3->execute(array($id[0]));

	$_SESSION['deleteBooster'] = 1;
	echo "<script>window.location='index.php'</script>";
//	header('Location: index.php');

?>