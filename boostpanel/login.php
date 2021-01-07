<?php require 'assets/class/init.php';

	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->login();

	// Get website name
	$wb = new Website();
	$website = $wb->getName();
	$user = -1;

	// If user want to sign in
	if(isset($_POST['sign_in']))
	{
		// Email verifications:
		if(!empty($_POST['email'])){
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$email = true;
		}else{
			$emailError = "Enter a correct e-mail.";
			$email = false;
		}
		}else{
			$emailError = "Enter your e-mail.";
			$email = false;
		}

		// Password verifications:
		if(!empty($_POST['password'])){
			$password = true;
		}else{
			$passwordError = "Enter your password.";
			$password = false;
		}

		// Verify user
		if($email == true && $password == true)
		{
			$req = $db->prepare("SELECT id, email, password, type FROM users WHERE email = ? AND password = ?");
			$req->execute(array($_POST['email'], hash('SHA512', $_POST['password'])));
			$user = $req->rowCount();

			if($user == 1)
			{
				// User exist
				// Get his stored data
				$user = $req->fetch();
				
				// If remember me is checked
				if(isset($_POST['remember_me']))
				{
					$token = hash('SHA256', $user['email']); // Token for remember me
					setcookie("remember", $token, time()+7 * 24 * 60 * 60); // Set cookie with the token for 1 week
					// Insert the token in database
					$cookie = $db->prepare("UPDATE users SET token = ? WHERE email = ?");
					$cookie->execute(array($token, $_POST['email']));
				}

				// Activate Sessions, and headers
				$_SESSION['id'] = $user['id']; // Store in Session, the ID of the user
				$_SESSION['type'] = $user['type']; // Store in Session, the type of the user (admin, member, booster)

				if($_SESSION['type'] === "admin")
				{
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/dashboard/index.php?sid='.$user['id'].'&user='.$user['type'].'"
					</SCRIPT>';
				}else if($_SESSION['type'] === "booster")
				{
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/booster/index.php?sid='.$user['id'].'&user='.$user['type'].'"
					</SCRIPT>';
				}else if($_SESSION['type'] === "member")
				{
					// Update current league, LP
					$update = new Member();
					$update->updateOrderLeague();
					
					echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="https://smurfbuddy.com/boostpanel/member/index.php?sid='.$user['id'].'&user='.$user['type'].'"
					</SCRIPT>';
				}else{
					// Error
				}
			}
		}

	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $website; ?> - Login</title>
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
	<div class="login-box" style="    font-size: 20px;">

		<div class="login-box-body">
			<p class="login-box-msg">Sign in to access our Boosting Panel!</p>
			<?php 
				if($user == 0)
				{
					echo "<div class='callout callout-danger'>
							<p>Email or password false.</p>
						</div>";
				}
			?>
			<form action="#" method="POST">
				<div class="form-group has-feedback 
				<?php 
					if(!empty($emailError))
						{ 
							echo 'has-error'; 
						}
				?>">
				<?php
					if(!empty($emailError))
					{
						echo "<label class='control-label' for='inputError'><i class='fa fa-times-circle-o'></i> Email</label>";
					}
				?>
					<input type="email" name="email" <?php if(!empty($emailError)){echo "id='inputError'";} ?> value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" class="form-control" placeholder="Email">
					<i class="fa fa-envelope form-control-feedback"></i>
					<?php
						if(!empty($emailError))
						{
							echo "<span class='help-block'>$emailError</span>";
						}
					?>
				</div>
				<div class="form-group has-feedback <?php 
					if(!empty($passwordError))
						{ 
							echo 'has-error'; 
						}
				?>">
				<?php
					if(!empty($passwordError))
					{
						echo "<label class='control-label' for='inputError'><i class='fa fa-times-circle-o'></i> Password</label>";
					}
				?>
					<input type="password" name="password" class="form-control" <?php if(!empty($passwordError)){echo "id='inputError'";} ?> placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
					<i class="fa fa-lock form-control-feedback"></i>
					<?php
						if(!empty($passwordError))
						{
							echo "<span class='help-block'>$passwordError</span>";
						}
					?>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
								<input type="checkbox" name="remember_me"> Remember Me
							</label>
						</div>
						<a href="forgot.php">Forgot password?</a>
					</div>
					<div class="col-xs-4">
						<button type="submit" name="sign_in" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>


  <!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<!--End of Tawk.to Script-->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>