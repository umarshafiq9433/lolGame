<?php

	$id = $_GET['id'];
	require '../assets/class/Database.php';

	$req = $db->prepare("DELETE FROM orders WHERE order_id = ?");
	$req->execute(array($id));

echo "<script>window.location='index.php'</script>";
	//header('location: index.php');

?>