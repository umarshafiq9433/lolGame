<?php
	require '../assets/class/init.php';

	// Get website name
	$wb = new Website();
	$website = $wb->getName();

	// Verify is user don't have cookie / redirect user
	$redirect = new Redirect();
	$redirect->member();

	// Profile of the user
	$profile = new Profile();
	$user = $profile->getProfile();
	$profile->change();

	// Orders
	$order = new Order();
	$order = $order->getOrder();
	// Member
	$member = new Member();
	$member->accountChange();
	$allOrders = $member->allOrders();

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
		              <img src="../assets/img/avatars/<?php echo $user['avatar'] ;?>" class="user-image" alt="User Image">
		              <!-- hidden-xs hides the username on small devices so only the image appears. -->
		              <span class="hidden-xs"><?php echo $user['username']; ?></span>
		            </a>
		            <ul class="dropdown-menu">
		              <!-- The user image in the menu -->
		              <li class="user-header">
		                <img src="../assets/img/avatars/<?php echo $user['avatar'] ;?>" class="img-circle" alt="User Image">
		                <p>
		                  <?php echo $user['username']; ?>
		                  <small>Member</small>
		                </p>
		              </li>
		              <!-- Menu Footer-->
		              <li class="user-footer">
		                <div class="pull-left">
		                  <a href="" data-toggle="modal" data-target="#modalProfile"  class="btn btn-default btn-flat">Profile</a>
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
		        <img src="../assets/img/avatars/<?php echo $user['avatar'] ;?>" class="img-circle" alt="User Image">
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
				<h1>Order overview   <?php
								    if(COUNT($allOrders) > 0)
								    {
								        ?>
							<select class="form-control" name="ordermaindetail" id="ordermaindetail" style="    display: inline-block;margin-left:10px;
    width: 10%;" >
								    <?php foreach($allOrders as $allOrder){
								        echo "<option value='".$allOrder['order_id']."' data-server='".$allOrder['lol_server']."' data-summoner='".$allOrder['lol_summoner']."' data-username='".$allOrder['lol_account']."' data-password='".$allOrder['lol_password']."'>".$allOrder['order_id']."</option>";
								    }
								    ?></select>
						<?php
								    }
								    ?></h1>
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
								    <?php $i=1; foreach($allOrders as $allOrder){
								        $pause = $allOrder['order_pause'];
								        if($pause == "Pause")
								        {
								            $pauseval = "Resume";
								        }
								        else
								        {
								            $pauseval = "Pause";
								        }
								        if($i==1){ $cl="style='display:inline-block'"; } else { $cl="style='display:none'"; }
								        ?>
									<a id="prbtn" href="pause.php?id=<?php echo $allOrder['order_id']; ?>&status=<?php echo $pause; ?>" <?php echo $cl; ?> class="prbtns prbtn_<?php echo $allOrder['order_id']; ?> btn-sm btn-primary btn-flat"><?php echo $pause . " Order"; ?></a>
									<?php
									$i++;
								    }
								    ?>
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
							    <?php $i=1; foreach($allOrders as $allOrder){
							        if($i==1){ $cll="style='display:block'"; } else { $cll="style='display:none'"; }
							        ?>
							        <div class="ordetails ordetail_<?php echo $allOrder['order_id']; ?>" <?php echo $cll; ?>>
								<strong>ID Order : </strong>
								<span class="pull-right"><?php echo $allOrder['order_id']; ?></span>
								<br>
								<strong>Queue : </strong>
								<span class="pull-right"><?php echo $allOrder['order_queue']; ?></span>
								<br>
								<strong>Order boost :</strong>
								<span class="pull-right"><?php echo $allOrder['order_boost']; ?></span>
								<br>
								<strong>Order type :</strong>
								<span class="pull-right"><span class="badge bg-green" style="vertical-align: top;"><?php echo $allOrder['order_type']; ?></span></span>
								<br>
								<strong>Price : </strong>
								<span class="pull-right"><?php echo $allOrder['order_price']; ?> €</span>
								<br>
								<strong>Status order : </strong>
								<span class="pull-right"><?php echo $allOrder['order_status']; ?></span>
								<br>
								<strong>Date : </strong>
								<span class="pull-right"><?php echo $allOrder['order_date']; ?></span>
								</div>
								<?php
								$i++; }
								?>
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
							    <form action="" method="POST">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">

												    <input type="hidden" name="order_id" id="oid" value="<?php echo $allOrders[0]['order_id']; ?>">
												<label>Server :</label>
												<select name="server" class="servers form-control">
													<option value="EUW" <?php if($allOrders[0]['lol_server'] === 'EUW'){echo "selected";} ?>>EUW</option>
													<option value="EUNE" <?php if($allOrders[0]['lol_server'] === 'EUNE'){echo "selected";} ?>>EUNE</option>
													<option value="NA" <?php if($allOrders[0]['lol_server'] === 'NA'){echo "selected";} ?>>NA</option>
													<option value="OCE" <?php if($allOrders[0]['lol_server'] === 'OCE'){echo "selected";} ?>>OCE</option>
													<option value="TR" <?php if($allOrders[0]['lol_server'] === 'TR'){echo "selected";} ?>>TR</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Summoner name :</label>
												<input name="summonername" type="text" class="summonername form-control" placeholder="Enter your summoner name"
												value="<?php if($allOrders[0]['lol_summoner'] !== ''){echo $allOrders[0]['lol_summoner'];} ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Account name :</label>
												<input name="accountname" type="text" class="accountname form-control" placeholder="Enter your account name"
												value="<?php if($allOrders[0]['lol_account'] !== ''){echo $allOrders[0]['lol_account'];} ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Account password :</label>
												<input name="accountpassword" type="text" class="accountpassword form-control" placeholder="Enter your password"
												value="<?php if($allOrders[0]['lol_password'] !== ''){echo $allOrders[0]['lol_password'];} ?>">
											</div>
										</div>
									</div>

									<button name="account_save" type="submit" class="btn btn-block btn-primary">Save</button>
								</form>
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



								    <?php
								    $i=1;
								    foreach($allOrders as $allOrder){
								        $sl = $allOrder['current_league'];
								        $lp = $allOrder['current_lp'];
								    if($sl == "")
								    {
								        $sl = "Unranked";
								    }
								    if($lp == "")
								    {
								        $lp = 0;
								    }
								    if($i==1){ $style="style='display:block'"; } else { $style="style='display:none'"; }
								        ?>
									<div class="row ordersl" id="order_<?php echo $allOrder['order_id']; ?>" <?php echo $style; ?>>

										<div class="col-md-4 col-sm-4 col-xs-4 text-center">
											<h4>Started</h4>
											<img class="img-order-details img-responsive" src="../assets/img/tiers/<?php echo $allOrder['start_league'].$allOrder['start_division'] ;?>.png">
											<p><?php if($allOrder['order_boost'] === "Division"){echo $allOrder['start_league']." ".$allOrder['start_division'];
											}else if($allOrder['order_boost'] === "Net Wins"){
												echo $allOrder['start_league']." ".$allOrder['start_division'];
											}else if($allOrder['order_boost'] === "Placement")
											{
												echo $allOrder['start_league'];
											} ?></p>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 text-center">
											<h4 style="padding-bottom:45px;">Current</h4>
									  		<a style="font-weight: 600;font-size: 17px;" href="https://www.leagueofgraphs.com/summoner/<?php echo strtolower( $allOrders[0]['lol_server'] ); ?>/<?php echo $allOrders[0]['lol_summoner']; ?>" target="_blank">
												<img class="img-order-details img-responsive" style="width: 170px;" src="../assets/img/leagueofgraphs.png" />
											</a>
											<p style="margin-bottom: 0px;">
												<strong> </strong>
											</p>
											<a style="font-weight: 600;font-size: 17px;" href="https://www.leagueofgraphs.com/summoner/<?php echo strtolower( $allOrders[0]['lol_server'] ); ?>/<?php echo $allOrders[0]['lol_summoner']; ?>" target="_blank">Check my current rating!</a>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 text-center">
											<h4>Desired</h4>
											<img class="img-order-details img-responsive" src="../assets/img/tiers/<?php if($allOrder['order_boost'] === "Division"){echo $allOrder['desired_league'].$allOrder['desired_division'];}else{echo $allOrder['start_league'].$allOrder['start_division']; } ;?>.png">
											<p><?php if($allOrder['order_boost'] === "Division"){echo $allOrder['desired_league']." ".$allOrder['desired_division'];
											}else if($allOrder['order_boost'] === "Net Wins"){
												echo $allOrder['start_league']." ".$allOrder['start_division']." - ".$allOrder['order_wins']." games";
											}else if($allOrder['order_boost'] === "Placement")
											{
												echo $allOrder['start_league']." - ".$allOrder['order_wins']." games";
											} ?></p>
										</div>
									</div>
									<?php
									$i++;
								    }
								    ?>

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

									<div class="direct-chat-messages" id="content_message">
										<div id="messages">
										<!-- Live chat Messages -->
										</div>
									</div>
									<!-- Footer -->
									<div class="box-footer">
										<form id="chat" action="#" onSubmit="return false;">
											<div class="input-group">
												<input name="livechat_message" id="message" type="text" placeholder="Type Message ..." class="form-control">
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
											<?php foreach($allOrders as $allOrder){ ?>
												<tr>
													<td><?php echo $allOrder['order_id']; ?></td>
													<td><?php echo $allOrder['order_queue']; ?></td>
													<td>
													<?php
														if($allOrder['order_boost'] === "Division")
														{
															echo "Division - ".$allOrder['start_league']." ".$allOrder['start_division']." -> ".$allOrder['desired_league']." ".$allOrder['desired_division'];
														}else if($allOrder['order_boost'] === "Net Wins")
														{
															echo 'Net Wins - '.$allOrder['start_league']." ".$allOrder['start_division']." : ".$allOrder['order_wins']." wins";
														}else if($allOrder['order_boost'] === "Placement")
														{
															echo 'Placement - '.$allOrder['start_league']." : ".$allOrder['order_wins']." wins";
														}
													?>
													</td>
													<td><span class="badge bg-<?php if($allOrder['order_type'] === "Solo Boost"){echo "green";}else{echo "purple";}?>"><?php echo $allOrder['order_type']; ?></span></td>
													<td><?php echo $allOrder['date']; ?></td>
													<td><?php echo $allOrder['order_price']; ?> €</td>
													<td><?php echo $allOrder['order_status']; ?></td>
												</tr>
											<?php } ?>
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
<!-- My App.js -->
<script type="text/javascript">

	// Notify if the file is too big (50 Ko)
	var maxSize = '<?php echo $_SESSION['maxSize']; ?>';
	if(maxSize == 1)
	{
		toastr.warning('Your avatar should not exceed 2 Mb.', 'Avatar Size', {timeOut: 5000});
		<?php $_SESSION['maxSize'] = 0; ?>
	}

	// Notify if the extension of the file is not valid
	var extension = "<?php echo $_SESSION['extension']; ?>";
	if(extension == 1)
	{
		toastr.warning('Only the extensions JPG, JPEG, PNG are accepted.', 'Avatar Extension', {timeOut: 5000});
		<?php $_SESSION['extension'] = 0; ?>
	}

	// Notify if the import of the avatar failed
	var dep = "<?php echo $_SESSION['dep']; ?>";
	if(dep == 1)
	{
		toastr.warning('An unknown error occurred during the import of your avatar.', 'Import Error', {timeOut: 5000});
		<?php $_SESSION['dep'] = 0; ?>
	}

	// Notify if the import of the avatar is successful
	var avatar = "<?php echo $_SESSION['avatar']; ?>";
	if(avatar == 1)
	{
		toastr.success('Your avatar was well imported.', 'Avatar imported', {timeOut: 5000});
		<?php $_SESSION['avatar'] = 0; ?>
	}

	// Notify if the account informations changed
	var account_information = "<?php echo $_SESSION['account_information']; ?>";
	if(account_information == 1)
	{
		toastr.success('Your changes were made.', 'Account information updated', {timeOut: 5000});
		<?php $_SESSION['account_information'] = 0; ?>
	}

	// Notify if the password has been changed
	var password = "<?php echo $_SESSION['password']; ?>";
	if(password == 1)
	{
		toastr.success('Your password was well changed.', 'Password changed', {timeOut: 5000});
		<?php $_SESSION['password'] = 0; ?>
	}

	// Notify the user he paused the order
	var Resume = "<?php echo $_SESSION['Resume']; ?>";
	if(Resume == 1)
	{
		toastr.warning('You have Paused your order.', 'Paused order', {timeOut: 5000});
		<?php $_SESSION['Resume'] = 0; ?>
	}

	// Notify the user he resumed the order
	var Pause = "<?php echo $_SESSION['Pause']; ?>";
	if(Pause == 1)
	{
		toastr.success('You have resume your order.', 'Resume order', {timeOut: 5000});
		<?php $_SESSION['Pause'] = 0; ?>
	}

jQuery(document).ready(function()
{

jQuery("#orderdetail").change(function()
{
    jQuery(".ordersl").hide()
    jQuery("#order_"+jQuery(this).val()).show();

});

jQuery(document).on('submit','#chat', function(){
	            var order_id = jQuery("#ordermaindetail option:selected").val();
			var message = jQuery.trim(jQuery("#message").val());
			if(message != "")
			{
				jQuery.ajax({
					type: 'POST',
					data: '&message=' + message + '&order_id='+order_id,
					url: '../assets/class/ChatPoster.php',
					success: function(data)
					{
					}
				});
				document.getElementById('message').value = "";
			}else{
				alert("Enter a message");
			}
		});

		function getMessages(){
		    var order_id = jQuery("#ordermaindetail option:selected").val();
			jQuery.get('../assets/class/getMessages.php?order_id='+order_id, function(data) {
				jQuery("#messages").html(data);
			});
		}


		setInterval(function() {
			getMessages();
		},5000);




		jQuery("#ordermaindetail").change(function()
		{

		    var server = jQuery("#ordermaindetail option:selected").data("server");
		     var summoner = jQuery("#ordermaindetail option:selected").data("summoner");
		      var username = jQuery("#ordermaindetail option:selected").data("username");
		       var password = jQuery("#ordermaindetail option:selected").data("password");
		       jQuery("#oid").val(jQuery(this).val());

		       jQuery(".servers").val(server);
		       jQuery(".summonername").val(summoner);
		       jQuery(".accountname").val(username);
		       jQuery(".accountpassword").val(password);
				//jQuery("#prbtn").attr("href","pause.php?id="+jQuery(this).val());
				jQuery(".prbtns , .ordetails , .osnames").hide();
				jQuery(".prbtn_"+jQuery(this).val()).css("display","inline-block");
				jQuery(".ordetail_"+jQuery(this).val()).show();
				jQuery(".osname_"+jQuery(this).val()).show();

				jQuery(".ordersl").hide()
    jQuery("#order_"+jQuery(this).val()).show();

     jQuery.get('../assets/class/getMessages.php?order_id='+jQuery(this).val(), function(data) {
				jQuery("#messages").html(data);
			});
		})



		getMessages();

});

</script>
</body>
</html>