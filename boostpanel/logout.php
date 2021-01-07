<?php

	if(isset($_COOKIE['remember']))
	{
		setcookie('remember', '', time()-7000000000000);
	}
	session_start();
	session_destroy();

	//header('Location: login.php');
	echo "<script>window.location='login.php'</script>";
?>