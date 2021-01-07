<?php
	require '../assets/class/init.php';
	// Get website name
	$wb = new Website();
	$website = $wb->getName();
	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->booster();

	// Get orders
	$order = new Order();
	$ordersCount = $order->orderCount();
	$boosterOrders = $order->getOrderIDBooster();
	$id = $_GET['id']; // Order ID
	$_SESSION['order_id'] = $id;
	$actualOrder = $order->getOrderBooster($id);

	// Get Profile
	$profile = new Profile();
	$profile->change(); // profile modal
	$user = $profile->getProfile(); // Get username, avatar

	// Get percentage
	$req = $db->prepare("SELECT boosters.percentage FROM users INNER JOIN boosters ON boosters.email = users.email WHERE users.id = ?");
	$req->execute(array($_SESSION['id']));
	$perc = $req->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $website; ?> - Order <?php echo $actualOrder['order_id']; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../assets/dist/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/app.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/css/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-blue">
	<div class="wrapper">
		  <!-- Main Header -->
		  <header class="main-header">

		    <!-- Logo -->
		    <a href="#" class="logo">
		      <!-- logo for regular state and mobile devices -->
		      <span class="logo-lg"><?php echo $website; ?></span>
		    </a>

		    <!-- Header Navbar -->
		    <nav class="navbar navbar-static-top" role="navigation">
		      <!-- Sidebar toggle button-->
		      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		        <span class="sr-only">Toggle navigation</span>
		      </a>
		      <!-- Navbar Right Menu -->
		      <div class="navbar-custom-menu">
		        <ul class="nav navbar-nav">
		          <!-- /.messages-menu -->

		          <!-- User Account Menu -->
		          <li class="dropdown user user-menu">
		            <!-- Menu Toggle Button -->
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		              <!-- The user image in the navbar-->
		              <img src="../assets/img/avatars/<?php echo $user['avatar']; ?>" class="user-image" alt="User Image">
		              <!-- hidden-xs hides the username on small devices so only the image appears. -->
		              <span class="hidden-xs"><?php echo $user['username']; ?></span>
		            </a>
		            <ul class="dropdown-menu">
		              <!-- The user image in the menu -->
		              <li class="user-header">
		                <img src="../assets/img/avatars/<?php echo $user['avatar']; ?>" class="img-circle" alt="User Image">

		                <p>
		                  <?php echo $user['username']; ?>
		                  <small>Booster</small>
		                </p>
		              </li>
		              <!-- Menu Footer-->
		              <li class="user-footer">
		                <div class="pull-left">
		                  <a href="" data-toggle="modal" data-target="#modalProfile" class="btn btn-default btn-flat">Profile</a>
		                </div>
		                <div class="pull-right">
		                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
		                </div>
		              </li>
		            </ul>
		          </li>
		        </ul>
		      </div>
		    </nav>
		  </header>

		  <!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">

		  <!-- sidebar: style can be found in sidebar.less -->
		  <section class="sidebar">

		    <!-- Sidebar user panel (optional) -->
		    <div class="user-panel">
		      <div class="pull-left image">
		        <img src="../assets/img/avatars/<?php echo $user['avatar']; ?>" class="img-circle" alt="User Image">
		      </div>
		      <div class="pull-left info">
		        <p><?php echo $user['username']; ?></p>
		        <!-- Status -->
		        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		      </div>
		    </div>

		    <!-- Sidebar Menu -->
		    <ul class="sidebar-menu" data-widget="tree">
		      <li class="header">MENU</li>
		      <!-- Optionally, you can add icons to the links -->
		      <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
		      <li class="treeview">
		        <a href="#"><i class="fa fa-file-text-o"></i> <span>Orders</span>
		              <span class="pull-right-container">
		                <span class="label label-primary pull-right"><?php echo $ordersCount['0']; ?></span>
		              </span>
		            </a>
		        <ul class="treeview-menu">
		          <?php foreach($boosterOrders as $boosterOrder) { ?>
					<li><a href="order.php?id=<?php echo $boosterOrder['order_id']; ?>"><i class="fa fa-caret-right"></i><span><?php echo $boosterOrder['order_id']; ?></span></a></li>
		          <?php } ?>
		        </ul>
		      </li>
		      <li><a href="completed.php"><i class="fa fa-briefcase"></i> <span>Completed orders</span></a></li>
		      <li><a href="" data-toggle="modal" data-target="#modalProfile"><i class="fa fa-user"></i> <span>Edit profile</span></a></li>
		    </ul>
		    <!-- /.sidebar-menu -->
		  </section>
		  <!-- /.sidebar -->
		</aside>

		<!-- Content page -->
		<div class="content-wrapper">
			<!-- Content header -->
			<section class="content-header">
				<h1>Booster area <small>Order <?php echo $actualOrder['order_id']; ?></small>
				<a onclick="return confirm('Are you sure ?');" href="finished.php?id=<?php echo $actualOrder['order_id']; ?>" class="btn-sm btn-primary">Finished</a>
				<a onclick="return confirm('Are you sure you want to drop this order?');" href="drop.php?id=<?php echo $actualOrder['order_id']; ?>" class="btn-sm btn-warning">Drop</a></h1>

				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-briefcase"></i> Booster area</a></li>
					<li>Home</li>
					<li class="active">Order <?php echo $actualOrder['order_id']; ?></li>
				</ol>
			</section>

			<!-- Main Content -->
			<section class="content">
				<!-- account, password, server -->
				<div class="row">
					<!-- Account -->
					<div class="col-md-4 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-aqua">
								<i class="ion ion-person"></i>
							</span>
							<div class="info-box-content">
								<span class="info-box-test">
									Account
								</span>
								<span class="info-box-number">
									<?php echo $actualOrder['lol_account']; ?>
								</span>
								 <small><?php echo $actualOrder['order_type']; ?></small>
							</div>
						</div>
					</div>
					<!-- Password -->
					<div class="col-md-4 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-red">
								<i class="ion ion-locked"></i>
							</span>
							<div class="info-box-content">
								<span class="info-box-test">
									Password
								</span>
								<span class="info-box-number">
									<?php echo $actualOrder['lol_password']; ?>
								</span>
								 <small><?php echo $actualOrder['order_type']; ?></small>
							</div>
						</div>
					</div>
					<!-- Server -->
					<div class="col-md-4 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-orange">
								<i class="ion ion-earth"></i>
							</span>
							<div class="info-box-content">
								<span class="info-box-test">
									Server
								</span>
								<span class="info-box-number">
									<?php echo $actualOrder['lol_server']; ?>
								</span>
								 <small><?php echo $actualOrder['order_type']; ?></small>
							</div>
						</div>
					</div>
				</div>
				<!-- Live chat - Order -->
				<div class="row">
					<!-- Live Chat -->
					<div class="col-md-5">
						<div class="box box-primary direct-chat direct-chat-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Live Chat</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="direct-chat-messages" id="content_message">
										<div id="messages">
										<!-- Live chat Messages -->
										</div>
									</div>
									<!-- Footer -->
									<div class="box-footer">
										<form id="chat" action="#" onSubmit="return false;">
											<div class="input-group">
												<input id="message" type="text" placeholder="Type Message ..." class="form-control">
												<span class="input-group-btn">
													<button name="livechat_send" type="submit" class="btn btn-primary btn-flat">Send</button>
												</span>
											</div>
										</form>
									</div>
									<!-- End Footer -->
								</div>
							</div>
					</div>
					<!-- Order informations -->
					<div class="col-md-7">
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Order informations</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<strong>Queue : </strong>
									<span class="pull-right"><?php echo $actualOrder['order_queue']; ?></span>
									<br>

									<strong>Order boost : </strong>
									<span class="pull-right"><?php echo $actualOrder['order_boost']; ?></span>
									<br>

									<strong>Order type : </strong>
									<span class="pull-right"><span class="badge bg-<?php if($actualOrder['order_type'] === "Solo Boost"){echo "green";}else{echo "purple";} ?>" style="vertical-align: top;"><?php echo $actualOrder['order_type']; ?></span></span>
									<br>

									<strong>Details : </strong>
									<span class="pull-right">
										<?php
											if($actualOrder['order_boost'] === "Division")
												{
													echo $actualOrder['start_league']." ".$actualOrder['start_division']." -> ".$actualOrder['desired_league']." ".$actualOrder['desired_division'];
														}else if($actualOrder['order_boost'] === "Net Wins")
														{
															echo $actualOrder['start_league']." ".$actualOrder['start_division']." : ".$actualOrder['order_wins']." wins";
														}else if($actualOrder['order_boost'] === "Placement")
														{
															echo $actualOrder['start_league']." : ".$actualOrder['order_wins']." wins";
														}
													?></span>
									<br>
									<strong>Price : </strong>
									<span class="pull-right"><?php $price = $actualOrder['order_price'] * ($perc['percentage'] / 100); echo $price; ?> €</span>
									<br>
									<strong>Date : </strong>
									<span class="pull-right"><?php echo $actualOrder['order_date']; ?></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="box box-primary collapsed-box">
								<div class="box-header">
									<h3 class="box-title">Options</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<strong>Flash : </strong>
									<span class="pull-right"><?php echo $actualOrder['flash']; ?></span>
									<br>
									<br>
									<div class="form-group">
										<label>Order notes : </label>
										<textarea class="form-control" rows="10" style="resize: none;" readonly><?php echo $actualOrder['order_notes']; ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
</div>
<div class="main-footer text-center">
	<strong>Copyright © <?php echo date("Y"); ?> <?php echo $website; ?>.com.</strong>
	<p>League of Legends is a registered trademark of Riot Games, Inc. We are in no way affiliated with, associated with or endorsed by Riot Games, Inc.</p>
</div>

<!-- Profil Modal -->
<div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="modalProfileLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Edit your profile</h4>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="row">
					<!-- Avatar -->
					<div class="col-md-4 text-center">
						<img src="../assets/img/avatars/<?php echo $user['avatar'] ;?>" style="width:135px;" alt="Avatar" class="img-circle">
					</div>
					<!-- Others -->
					<div class="col-md-8">
						<form data-toggle="validator" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<input name="avatar" type="file" class="form-control">
						</div>
						<div class="form-group">
							<input name="password" type="password" class="form-control" placeholder="Your password" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<input name="new_password" id="password" type="password" class="form-control" placeholder="New Password">
						</div>
						<div class="form-group">
							<input type="password" data-match="#password" data-match-error="Password doesn't match" data-match-success="Password matches" class="form-control" placeholder="Confirm new password">
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="save_profile" class="btn btn-primary">Save</button>
			</form>
			</div>
		</div>
	</div>
</div>

  <!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../assets/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../assets/js/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../assets/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<!-- Boostrap validation form -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- App js -->
<script src="../assets/js/livechat.js"></script>
<script>

		// Redirect user if the order is paused
		var pause = "<?php echo $actualOrder['order_pause']; ?>";
		if(pause === "Resume"){
			alert("The order is paused, wait for the customer to resume it.");
			window.location = 'index.php';
		}

	// Notify if the file is too big (50 Ko)
	var maxSize = <?php echo $_SESSION['maxSize']; ?>;
	if(maxSize == 1)
	{
		toastr.warning('Your avatar should not exceed 2 Mb.', 'Avatar Size', {timeOut: 5000});
		<?php $_SESSION['maxSize'] = 0; ?>
	}

	// Notify if the extension of the file is not valid
	var extension = <?php echo $_SESSION['extension']; ?>;
	if(extension == 1)
	{
		toastr.warning('Only the extensions JPG, JPEG, PNG are accepted.', 'Avatar Extension', {timeOut: 5000});
		<?php $_SESSION['extension'] = 0; ?>
	}

	// Notify if the import of the avatar failed
	var dep = <?php echo $_SESSION['dep']; ?>;
	if(dep == 1)
	{
		toastr.warning('An unknown error occurred during the import of your avatar.', 'Import Error', {timeOut: 5000});
		<?php $_SESSION['dep'] = 0; ?>
	}

	// Notify if the import of the avatar is successful
	var avatar = <?php echo $_SESSION['avatar']; ?>;
	if(avatar == 1)
	{
		toastr.success('Your avatar was well imported.', 'Avatar imported', {timeOut: 5000});
		<?php $_SESSION['avatar'] = 0; ?>
	}

	// Notify if the password has been changed
	var password = <?php echo $_SESSION['password']; ?>;
	if(password == 1)
	{
		toastr.success('Your password was well changed.', 'Password changed', {timeOut: 5000});
		<?php $_SESSION['password'] = 0; ?>
	}

</script>
</body>
</html>