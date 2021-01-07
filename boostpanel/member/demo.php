<?php
	require '../assets/class/init.php';

	// Get website name
	$wb = new Website();
	$website = $wb->getName();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $website; ?> - Member area</title>
	<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../assets/dist/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/app.css">
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
		      <a href="/" class="a-herf">
		        <span class="sr-only">Return to Home</span>
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
		              <img src="../assets/img/avatars/0.png" class="user-image" alt="User Image">
		              <!-- hidden-xs hides the username on small devices so only the image appears. -->
		              <span class="hidden-xs">Demo</span>
		            </a>
		            <ul class="dropdown-menu">
		              <!-- The user image in the menu -->
		              <li class="user-header">
		                <img src="../assets/img/avatars/0.png" class="img-circle" alt="User Image">
		                <p>
		                  Demo
		                  <small>Member</small>
		                </p>
		              </li>
		              <!-- Menu Footer-->
		              <li class="user-footer">
		                <div class="pull-left">
		                  <a href="" data-toggle="modal" data-target="#modalProfile"  class="btn btn-default btn-flat">Profile</a>
		                </div>
		                <div class="pull-right">
		                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
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
		        <img src="../assets/img/avatars/0.png" class="img-circle" alt="User Image">
		      </div>
		      <div class="pull-left info">
		        <p>Demo</p>
		        <!-- Status -->
		        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		      </div>
		    </div>

		    <!-- Sidebar Menu -->
		    <ul class="sidebar-menu" data-widget="tree">
		      <li class="header">MENU</li>
		      <!-- Optionally, you can add icons to the links -->
		      <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Home</span></a></li>
		      <li><a href="" data-toggle="modal" data-target="#modalProfile" ><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
		    </ul>
		    <!-- /.sidebar-menu -->
		  </section>
		  <!-- /.sidebar -->
		</aside>

		<!-- Content page -->
		<div class="content-wrapper">
			<!-- Content header -->
			<section class="content-header">
				<h1>Order overview</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-laptop"></i> Order overview</a></li>
					<li class="active">Home</li>
				</ol>
			</section>

			<!-- Main Content -->
			<section class="content">
				<div class="row">
					<!-- Order -->
					<div class="col-md-6">
						<div class="box collapsed-box">
							<div class="box-header with-border">
								<h3 class="box-title">Order</h3>
								<div class="box-tools pull-right">
									<a href="" class="btn-sm btn-primary btn-flat">Pause</a>
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<strong>ID Order : </strong>
								<span class="pull-right">OR9547</span>
								<br>
								<strong>Queue : </strong>
								<span class="pull-right">Solo/Duo (5v5)</span>
								<br>
								<strong>Order boost :</strong>
								<span class="pull-right">Division boost</span>
								<br>
								<strong>Order type :</strong>
								<span class="pull-right"><span class="badge bg-green" style="vertical-align: top;">Solo Boost</span></span>
								<br>
								<strong>Price : </strong>
								<span class="pull-right">150 €</span>
								<br>
								<strong>Status order : </strong>
								<span class="pull-right">Order in progress</span>
								<br>
								<strong>Date : </strong>
								<span class="pull-right">27-09-2017 18:54</span>
							</div>
						</div>
					</div>
					<!-- End Order -->

					<!-- Account Information -->
					<div class="col-md-6">
						<div class="box collapsed-box">
							<div class="box-header with-border">
								<h3 class="box-title">Account Information</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Server :</label>
												<select class="form-control">
													<option>EUW</option>
													<option>EUNE</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Summoner name :</label>
												<input type="text" class="form-control" placeholder="Enter your summoner name">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Account name :</label>
												<input type="text" class="form-control" placeholder="Enter your account name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Account password :</label>
												<input type="text" class="form-control" placeholder="Enter your password">
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-block btn-primary">Save</button>
							</div>
						</div>
					</div>
					<!-- End Account Information -->
				</div>

					<div class="row">
						<!-- Order Details -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Order Details</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-4 text-center">
											<h4>Started</h4>
											<img class="img-order-details img-responsive" src="../assets/img/tiers/BronzeI.png">
											<p>Bronze I</p>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 text-center">
											<h4>Current</h4>
											<img class="img-order-details img-responsive" style="width: 200px;" src="../assets/img/tiers/GoldI.png">
											<p style="margin-bottom: 0px;">
												<strong>Gold I</strong>
											</p>
											<p>League Points : 0</p>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 text-center">
											<h4>Desired</h4>
											<img class="img-order-details img-responsive" src="../assets/img/tiers/DiamondI.png">
											<p>Diamond I</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Order Details -->

						<!-- CHAT -->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="box box-primary direct-chat direct-chat-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Live Chat</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body">
									<div class="direct-chat-messages">
										<!-- Demo -->
										<div class="direct-chat-msg">
											<div class="direct-chat-info clearfix">
												<span class="direct-chat-name pull-left">Demo</span>
												<span class="direct-chat-timestamp pull-right">27/09 20:57</span>
											</div>
											<img class="direct-chat-img" src="../assets/img/avatars/0.png" alt="Message user Image">
											<div class="direct-chat-text">
												Damn, you're so good !
											</div>
										</div>
										<!-- End Demo -->
										<!-- Booster -->
										<div class="direct-chat-msg right">
											<div class="direct-chat-info clearfix">
												<span class="direct-chat-name pull-right">Demo</span>
												<span class="direct-chat-timestamp pull-left">27/09 20:57</span>
											</div>
											<img class="direct-chat-img" src="../assets/img/avatars/0.png" alt="Message user Image">
											<div class="direct-chat-text">
												Aha, thanks, I go for another one ;)
											</div>
										</div>
										<!-- End Booster -->
									</div>
									<!-- Footer -->
									<div class="box-footer">
										<form action="#" method="POST">
											<div class="input-group">
												<input type="text" placeholder="Type Message ..." class="form-control">
												<span class="input-group-btn">
													<button type="submit" class="btn btn-primary btn-flat">Send</button>
												</span>
											</div>
										</form>
									</div>
									<!-- End Footer -->
								</div>
							</div>
						</div>
						<!-- End Chat -->
					</div>

					<div class="row">
						<!-- Orders -->
						<div class="col-xs-12">
							<div class="box box-success">
								<div class="box-header">
									<h3 class="box-title">Your Orders</h3>
								</div>
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tbody>
											<tr>
												<th>ID</th>
												<th>Queue</th>
												<th>Boost</th>
												<th>Type</th>
												<th>Date</th>
												<th>Price</th>
												<th>Status</th>
											</tr>
											<tr>
												<td>OR9547</td>
												<td>Solo/Duo (5v5)</td>
												<td>Division - Bronze I -> Diamond I</td>
												<td><span class="badge bg-green">Solo Boost</span></td>
												<td>27-09-2017</td>
												<td>150 €</td>
												<td>Order in progress</td>
											</tr>
											<tr>
												<td>OR1478</td>
												<td>Flex (5v5)</td>
												<td>Net Win - Bronze III : 5 Wins</td>
												<td><span class="badge bg-purple">Duo Boost</span></td>
												<td>22-09-2017</td>
												<td>57 €</td>
												<td>Finished</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- End Order -->
					</div>

	</section>
</div>
<div class="main-footer text-center">
	<strong>Copyright © <?php echo date("Y"); ?> <?php echo $website; ?>.com</strong>
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
						<img src="../assets/img/avatars/0.png" style="width:135px;" alt="Avatar" class="img-circle">
					</div>
					<!-- Others -->
					<div class="col-md-8">
						<div class="form-group">
							<input type="file" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Your password">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="New password">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Confirm new password">
						</div>
					</div>
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save</button>
			</div>
		</div>
	</div>
</div>

  <!-- jQuery 3 -->
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
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
</body>
</html>