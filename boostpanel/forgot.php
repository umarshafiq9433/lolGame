<?php 
function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
	// Load class
	require 'assets/class/init.php';

	// Get website name
	$wb = new Website();
	$website = $wb->getName();
	$user = -1;

	// Verify if email exist in database
	if(isset($_POST['forgot_password']))
	{
		$req = $db->prepare("SELECT email FROM users WHERE email = ?");
		$req->execute(array($_POST['email']));
		$user = $req->rowCount();

		if($user == 1) // User exist
		{
			// Create a new password and send it
			$password = randomString(7);

			$req = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
			$req->execute(array(hash('SHA512', $password), $_POST['email']));

			mail($_POST['email'], $website." - New password", "Hello, there is your new password : ".$password);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $website; ?> - Forgot password</title>
	<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/dist/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/dist/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/app.css">
  <!-- iCheck CSS -->
  <link rel="stylesheet" href="assets/css/iCheck.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	
	<div class="login-box">
		<div class="login-logo">
			<?php echo $website; ?>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Write your email, you'll receive an email with a new password in.</p>
			<?php 
				if($user == 1)
				{
					echo "<div class='callout callout-success'>
							<p>New password sent.</p>
						</div>";
				}else if($user == 0){
					echo "<div class='callout callout-danger'>
							<p>This email don't exist.</p>
						</div>";
				}
			?>
			<form action="#" method="POST" data-toggle="validator">
				<div class="form-group has-feedback">
					<input type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" placeholder="Email" required>
					<i class="fa fa-envelope form-control-feedback"></i>
					<div class="help-block with-errors"></div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" name="forgot_password" class="btn btn-primary btn-block btn-flat">Send</button>
					</div>
				</div>
			</form>
		</div>
	</div>


  <!-- jQuery 3 -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Boostrap validation form -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

</body>
</html>