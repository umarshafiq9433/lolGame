<?php
	require '../assets/class/init.php';
	// Get website name
	$wb = new Website();
	$website = $wb->getName();

	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->dashboard();

	// Add booster
	$booster = new Booster();
	$booster->addBooster(); // Add booster
	$boosters = $booster->Boosters(); // Get boosters

	// Get Orders
	$order = new Order();
	$runingOrders = $order->runingOrders(); // Get runing Orders
	$waitingBoosters = $order->waitingOrders(); // Get Waiting orders
	$finishedOrders = $order->finishedOrders(); // Get finished orders

	// Profile
	$profile = new Profile();
	$user = $profile->getProfile();
	$profile->change();

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

	if(isset($_POST['order_save']))
	{
		$order_id = randomString(5);
		$req = $db->prepare("INSERT INTO users SET username = ?, email = ?, password = ?, order_id = ?");
		$req->execute(array($_POST['user_username'], $_POST['user_email'], hash('SHA512', $_POST['user_password']), $order_id));

		$r = $db->prepare("SELECT id FROM users WHERE email = ?");
		$r->execute(array($_POST['user_email']));
		$OrderUser = $r->fetch();

		if(!empty($_POST['wins']))
		{
			$wins = $_POST['wins'];
		}else{
			$wins = 0;
		}

		$res = $db->prepare("INSERT INTO orders SET order_id = ?, lol_account = ?, lol_password = ?, lol_summoner = ?, lol_server = ?, start_league = ?, start_division = ?, current_league = ?, current_division = ?, desired_league = ?, desired_division = ?, order_boost = ?, order_wins = ?, order_type = ?, user_id = ?, order_price = ?");
		$res->execute(array($order_id, $_POST['lol_account'], $_POST['lol_password'], $_POST['lol_summoner'], $_POST['server'], $_POST['start_league'], $_POST['start_division'], $_POST['start_league'], $_POST['start_division'], $_POST['desired_league'], $_POST['desired_division'], $_POST['boost_type'], $wins, $_POST['duo'], $OrderUser['id'], $_POST['price']));

		$f = $db->prepare("INSERT INTO options SET order_id = ?, flash = ?");
		$f->execute(array($order_id, $_POST['flash']));

		header("Location: index.php");

	}

	if(isset($_POST['add_account'])) {
		$req = $db->prepare("INSERT INTO account_shop SET type = ?, login = ?, password = ?, server = ?");
		$req->execute(array($_POST['account_type'], $_POST['account_login'], $_POST['account_password'], $_POST['account_server']));

		$_SESSION['addAccount'] = 1;

		header("Location: index.php");
	}
	if(isset($_POST['booster_esave'])) {
	    
	    $name = $_POST['username'];
	    $email = $_POST['memail'];
	    $paypal = $_POST['paypal'];
	    $rank = $_POST['rank'];
	    $percentage = $_POST['percentage'];
	     
		
		$req = $db->prepare("UPDATE users set username = ? where email = ?");
		$req->execute(array($name, $email));
		
		$req1 = $db->prepare("UPDATE boosters set paypal = ?, percentage = ?, rank = ? where email = ?");
		$req1->execute(array($paypal, $percentage,$rank , $email));
		
echo "<script>window.location='index.php'</script>";
		 //header("Location: index.php");
	}
	
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $website; ?> - Admin area</title>
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
		                  <small>Admin</small>
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
		      <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Home</span></a></li>
		      <li><a href="" data-toggle="modal" data-target="#modalAccount"><i class="fa fa-plus-square"></i> <span>Add an account</span></a></li>
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
				<h1>Admin area</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-user-secret"></i> Admin area</a></li>
					<li class="active">Home</li>
				</ol>
			</section>

			<!-- Main Content -->
			<section class="content">
				<div class="row">
					<!-- Finished orders -->
					<div class="col-xs-12">
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="box-title">Finished orders</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="box-body table-responsive no-padding">
								<table class="table table-hover">
									<tbody>
										<tr>
											<th>ID</th>
											<th>Queue</th>
											<th>Boost</th>
											<th>Date</th>
											<th>Price</th>
											<th>Summoner name</th>
											<th>Booster name</th>
											<th>Booster price</th>
											<th>Booster PayPal</th>
											<th>Action</th>
										</tr>
										<?php foreach($finishedOrders as $finishedOrder) { ?>
											<tr>
												<td><?php echo $finishedOrder['order_id']; ?></td>
												<td><?php echo $finishedOrder['order_queue']; ?></td>
												<td>
												<?php 
														if($finishedOrder['order_boost'] === "Division")
														{
															echo "Division - ".$finishedOrder['start_league']." ".$finishedOrder['start_division']." -> ".$finishedOrder['desired_league']." ".$finishedOrder['desired_division'];
														}else if($finishedOrder['order_boost'] === "Net Wins")
														{
															echo 'Net Wins - '.$finishedOrder['start_league']." ".$finishedOrder['start_division']." : ".$finishedOrder['order_wins']." wins";
														}else if($finishedOrder['order_boost'] === "Placement")
														{
															echo 'Placement - '.$finishedOrder['start_league']." : ".$finishedOrder['order_wins']." wins";
														}
													?>
													</td>
													<td><?php echo $finishedOrder['date']; ?></td>
													<td><?php echo $finishedOrder['order_price']; ?> €</td>
													<td><?php echo $finishedOrder['lol_summoner']; ?></td>
													<td><?php echo $finishedOrder['username']; ?></td>
													<td><?php $price = $finishedOrder['order_price'] * ($finishedOrder['percentage'] / 100); echo $price; ?> €</td>
													<td><?php echo $finishedOrder['paypal']; ?></td>
													<td><a onclick="return confirm('Are you sure you paid this booster ?');" href="payed.php?id=<?php echo $finishedOrder['booster_id']; ?>" class="btn btn-xs btn-primary">Paid</a><a href="delete.php?id=<?php echo $finishedOrder['order_id']; ?>" class="btn btn-xs btn-danger">Delete</a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
			</div>
				<!-- Boosters -->
				<div class="row">
					<div class="col-md-5">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Runing orders</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tbody>
											<tr>
												<th>ID</th>
												<th>Price</th>
												<th>Booster</th>
												<th>Status</th>
												<th>Options</th>
											</tr>
											<?php foreach($runingOrders as $runingOrder) { ?>
												<tr>
													<td><?php echo $runingOrder['order_id']; ?></td>
													<td><?php echo $runingOrder['order_price']; ?> €</td>
													<td><?php echo $runingOrder['username']; ?></td>
													<td><?php echo $runingOrder['order_status']; ?></td>
													<td><span data-id="<?php echo $runingOrder['order_id']; ?>" class="chatstart btn btn-xs btn-warning">Chat</span><a onclick="return confirm('Are you sure you want to drop this order?');" href="drop.php?id=<?php echo $runingOrder['order_id']; ?>&bid=<?php echo $runingOrder['booster_id']; ?>" class="btn btn-xs btn-danger">Drop</a></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>	
								</div>
							</div>	
						</div>
						<div class="chatbox box" style="display:none">
							<div class="box-header">
								<h3 class="box-title">Live Chat</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="box-body table-responsive no-padding"> 
								    
								    
									<div class="direct-chat-messages" id="content_message">
										<div id="messages">
										<!-- Live chat Messages -->
										</div>
									</div> 
								</div>
							</div>
						</div>
						<!-- End Chat -->
						
						
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Waiting for boosters orders</h3>
								<div class="box-tools pull-right">
									<a href="" data-toggle="modal" data-target="#modalAddOrder" class="btn btn-sm btn-primary">Add an order</a>
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tbody>
											<tr>
												<th>ID</th>
												<th>Price</th>
												<th>Status</th>
											</tr>
											<?php foreach($waitingBoosters as $waitOrder) { ?>
												<tr>
													<td><?php echo $waitOrder['order_id']; ?></td>
													<td><?php echo $waitOrder['order_price']; ?> €</td>
													<td><?php echo $waitOrder['order_status']; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>	
								</div>
							</div>	
						</div>
					</div>
					<div class="col-md-7">
						<div class="box box-warning">
							<div class="box-header">
								<h3 class="box-title">Boosters</h3>
								<div class="box-tools pull-right">
									<a href="" data-toggle="modal" data-target="#modalAddBooster" class="btn btn-sm btn-warning">Add a booster</a>
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tbody>
											<tr>
												<th>Name</th>
												<th>Rank</th>
												<th>PayPal</th>
												<th>Percentage</th>
												<th>Action</th>
											</tr>
											<?php foreach($boosters as $booster) { ?>
												<tr>
													<td><?php echo $booster['username']; ?></td>
													<td><?php echo $booster['rank']; ?></td>
													<td><?php echo $booster['paypal']; ?></td>
													<td><?php echo $booster['percentage']; ?> %</td>
													<td><a href="" data-toggle="modal"   data-target="#modaleditBooster" class="editboosterbtn btn btn-xs btn-warning" data-name="<?php echo $booster['username']; ?>" data-rank="<?php echo $booster['rank']; ?>" data-paypal="<?php echo $booster['paypal']; ?>" data-percentage="<?php echo $booster['percentage']; ?>" data-email="<?php echo $booster['email']; ?>">Edit</a>
														<a onclick="return confirm('Are you sure you want to delete this booster?');" href="deleteBooster.php?email=<?php echo $booster['email']; ?>" class="btn btn-xs btn-danger">Delete</a>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>	
								</div>
							</div>
						</div>
					</div>
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
						<img src="../assets/img/avatars/<?php echo $user['avatar']; ?>" style="width:135px;" alt="Avatar" class="img-circle">
					</div>
					<!-- Others -->
					<div class="col-md-8">
						<form actin="" method="POST" data-toggle="validator" enctype="multipart/form-data">
						<div class="form-group">
							<input name="avatar" type="file" class="form-control">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Your password" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<input name="new_password" id="boosterPassword" type="password" class="form-control" placeholder="New Password">
						</div>
						<div class="form-group">
							<input type="password" data-match="#boosterPassword" data-match-error="Password doesn't match" data-match-success="Password matches" class="form-control" placeholder="Confirm New Password">
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

<!-- Add account modal-->
<div class="modal fade" id="modalAccount" tabindex="-1" role="dialog" aria-labelledby="modalAccountLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Add an account</h4>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<div class="row">
						<form action="" method="POST" data-toggle="validator">
							<div class="col-xs-12">
								<div class="form-group">
									<select class="form-control" name="account_type">
										<option value="Basic Account">Basic Account</option>
										<option value="Standard Account">Standard Account</option>
										<option value="Epic Account">Epic Account</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<select class="form-control" name="account_server">
										<option value="EUW">EUW</option>
										<option value="EUNE">EUNE</option>
										<option value="NA">NA</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<input type="text" name="account_login" class="form-control" placeholder="Account username" required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group">
									<input type="text" name="account_password" class="form-control" placeholder="Account password" required>
									<div class="help-block with-errors"></div>
								</div>
							</div>
				</div>	
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="add_account" class="btn btn-primary">Save</button>
			</form>
			</div>
		</div>
	</div>
</div>

<!-- Add Booster Modal -->
<div class="modal fade" id="modalAddBooster" tabindex="-1" role="dialog" aria-labelledby="modalProfileLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Add a booster</h4>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form data-toggle="validator" action="" method="POST">
				<div class="row">
					<div class="col-md-6">
							<div class="form-group has-feedback">
								<input type="text" name="username" placeholder="Booster name" class="form-control" required>
								 <div class="help-block with-errors"></div>
							</div>
							<div class="form-group has-feedback">
								<input type="email" name="email" placeholder="Booster email" class="form-control" data-error="Email is not valid" required>
								<div class="help-block with-errors"></div>
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group has-feedback">
							<input type="password" name="password" id="password" placeholder="Booster password" class="form-control" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group has-feedback">
							<input type="password" name="confirm_password" placeholder="Confirm password" data-match="#password" data-match-error="Password doesn't match" class="form-control" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group has-feedback">
							<input type="email" class="form-control" name="paypal" placeholder="Paypal Email" data-error="Email is not valid" required>
							<div class="help-block with-errors"></div>
						</div>	
						<div class="form-group has-feedback">
							<select class="form-control" name="rank">
								<option value="Challenger I">Challenger I</option>
								<option value="Master I">Master I</option>
								<option value="Diamond I">Diamond I</option>
								<option value="Diamond II">Diamond II</option>
								<option value="Diamond III">Diamond III</option>
								<option value="Diamond IV">Diamond IV</option>
								<option value="Diamond V">Diamond V</option>
							</select>
						</div>
						<div class="form-group has-feedback">
							<input type="number" class="form-control" min="0" max="100" name="percentage" placeholder="Booster percentage" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>	
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="booster_save" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Add Booster Modal -->
<div class="modal fade" id="modaleditBooster" tabindex="-1" role="dialog" aria-labelledby="modalProfileLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Edit Booster</h4>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form data-toggle="validator" action="" method="POST">
				<div class="row">
					<div class="col-md-6">
							<div class="form-group has-feedback">
							    <input type="hidden" name="memail" class="bemail">
								<input type="text" name="username" placeholder="Booster name" class="bname form-control" required>
								 <div class="help-block with-errors"></div>
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group has-feedback">
							<input type="email" class="bpaypal form-control" name="paypal" placeholder="Paypal Email" data-error="Email is not valid" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div> 
				<div class="row">
					<div class="col-xs-12"> 	
						<div class="form-group has-feedback">
							<select class="brank form-control" name="rank">
								<option value="Challenger I">Challenger I</option>
								<option value="Master I">Master I</option>
								<option value="Diamond I">Diamond I</option>
								<option value="Diamond II">Diamond II</option>
								<option value="Diamond III">Diamond III</option>
								<option value="Diamond IV">Diamond IV</option>
								<option value="Diamond V">Diamond V</option>
							</select>
						</div>
						<div class="form-group has-feedback">
							<input type="number" class="bpercentage form-control" min="0" max="100" name="percentage" placeholder="Booster percentage" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>	
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="booster_esave" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Add Booster Modal -->
<div class="modal fade" id="modalAddOrder" tabindex="-1" role="dialog" aria-labelledby="modalProfileLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!-- Modal header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Add an order</h4>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				<form data-toggle="validator" action="" method="POST">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Username : </label>
							<input name="user_username" type="text" class="form-control" placeholder="Username" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Email : </label>
							<input name="user_email" type="text" class="form-control" placeholder="User Email" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-md-4">
						<label>Password : </label>
						<div class="form-group">
							<input name="user_password" type="text" class="form-control" placeholder="User password" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>	
				</div>
				<hr>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>LoL account : </label>
							<input name="lol_account" type="text" class="form-control" placeholder="If solo boost">
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>LoL password : </label>
							<input name="lol_password" type="text" class="form-control" placeholder="If Solo Boost">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Summoner name : </label>
							<input name="lol_summoner" type="text" class="form-control" placeholder="Summoner name" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Server : </label>
							<select name="server" class="form-control">
								<option value="EUW">EUW</option>
								<option value="EUNE">EUNE</option>
								<option value="NA">NA</option>
								<option value="OCE">OCE</option>
								<option value="TR">TR</option>
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Start League</label>
							<select name="start_league" class="form-control">
								<option value="Bronze">Bronze</option>
								<option value="Silver">Silver</option>
								<option value="Gold">Gold</option>
								<option value="Platinum">Platinum</option>
								<option value="Diamond">Diamond</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Desired League</label>
							<select name="desired_league" class="form-control">
								<option value="Bronze">Bronze</option>
								<option value="Silver">Silver</option>
								<option value="Gold">Gold</option>
								<option value="Platinum">Platinum</option>
								<option value="Diamond">Diamond</option>
								<option value="Master">Master</option>
								<option value="Challenger">Challenger</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Boost Type</label>
							<select name="boost_type" class="form-control">
								<option value="Division">Division Boost</option>
								<option value="Net Wins">Wins Boost</option>
								<option value="Placement">Placement Boost</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Start Division</label>
							<select name="start_division" class="form-control">
								<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
								<option value="V">V</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Desired Division</label>
							<select name="desired_division" class="form-control">
								<option value="I">I</option>
								<option value="II">II</option>
								<option value="III">III</option>
								<option value="IV">IV</option>
								<option value="V">V</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Duo Boost</label>
							<select name="duo" class="form-control">
								<option value="Duo Boost">Yes</option>
								<option value="Solo Boost">No</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Wins (If placement, net wins)</label>
							<input name="wins" type="number" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Flash</label>
							<select name="flash" class="form-control">
								<option value="F">On F</option>
								<option value="D">On D</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Price</label>
							<input name="price" type="number" class="form-control" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" name="order_save" class="btn btn-primary">Save</button>
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
<script type="text/javascript">

	// Notify if account has been added
	var addAccount = '<?php echo $_SESSION['addAccount']; ?>';
	if(addAccount == 1)
	{
		toastr.success('The account has been successfully added.', 'Account added.', {timeOut: 5000});
		<?php $_SESSION['addAccount'] = 0; ?>
	}

	// Notify if booster has been added
	var addBooster = '<?php echo $_SESSION['addBooster']; ?>';
	if(addBooster == 1)
	{
		toastr.success('Your booster has been successfully added.', 'Booster added', {timeOut: 5000});
		<?php $_SESSION['addBooster'] = 0; ?>
	}

	// Notify if booster has been deleted
	var deleteBooster = '<?php echo $_SESSION['deleteBooster']; ?>';
	if(deleteBooster == 1)
	{
		toastr.warning('Your booster has been successfully removed.', 'Booster removed', {timeOut: 5000});
		<?php $_SESSION['deleteBooster'] = 0; ?>
	}

	// Notify if the file is too big (50 Ko)
	var maxSize = '<?php echo $_SESSION['maxSize']; ?>';
	if(maxSize == 1)
	{
		toastr.warning('Your avatar should not exceed 2 Mb.', 'Avatar Size', {timeOut: 5000});
		<?php $_SESSION['maxSize'] = 0; ?>
	}

	// Notify if the extension of the file is not valid
	var extension = '<?php echo $_SESSION['extension']; ?>';
	if(extension == 1)
	{
		toastr.warning('Only the extensions JPG, JPEG, PNG are accepted.', 'Avatar Extension', {timeOut: 5000});
		<?php $_SESSION['extension'] = 0; ?>
	}

	// Notify if the import of the avatar failed
	var dep = '<?php echo $_SESSION['dep']; ?>';
	if(dep == 1)
	{
		toastr.warning('An unknown error occurred during the import of your avatar.', 'Import Error', {timeOut: 5000});
		<?php $_SESSION['dep'] = 0; ?>
	}

	// Notify if the import of the avatar is successful
	var avatar = '<?php echo $_SESSION['avatar']; ?>';
	if(avatar == 1)
	{
		toastr.success('Your avatar was well imported.', 'Avatar imported', {timeOut: 5000});
		<?php $_SESSION['avatar'] = 0; ?>
	}

	// Notify if the password has been changed
	var password = '<?php echo $_SESSION['password']; ?>';
	if(password == 1)
	{
		toastr.success('Your password was well changed.', 'Password changed', {timeOut: 5000});
		<?php $_SESSION['password'] = 0; ?>
	}

	// Notify for the payment of a booster
	var payed = '<?php echo $_SESSION['payed']; ?>';
	if(payed == 1)
	{
		toastr.success('Booster has been payed.', 'Payment', {timeOut: 5000});
		<?php $_SESSION['payed'] = 0; ?>
	}

jQuery(".editboosterbtn").click(function()
{
    var name = jQuery(this).data("name");
    var email = jQuery(this).data("email");
    var rank = jQuery(this).data("rank");
    var percentage = jQuery(this).data("percentage");
    var pemail = jQuery(this).data("paypal");
    
    jQuery(".bname").val(name);
    jQuery(".brank").val(rank).change();
    jQuery(".bpercentage").val(percentage);
    jQuery(".bpaypal").val(pemail);
    jQuery(".bemail").val(email);
})

jQuery(".chatstart").click(function()
{
jQuery(".chatbox").show();
var order_id = jQuery(this).data("id");
jQuery.get('getchat.php?order_id='+order_id, function(data) { 
				jQuery("#messages").html(data);
			});
});
</script>
</body>
</html>