<?php  
	include_once '../core/init.php';
	include_once '../core/functions.php';
	//check if the user is logged in else redirect the user to the login page
	if (!is_admin_logged_in()) {
		login_error_redirect();
	}
?>

<!DOCTYPE html>
<html>
	<?php 
		include_once '../admin/includes_admin/head_admin.php';
	?>
	<body>
		<header>
		<!--nav-->
			<nav class="nav navbar navbar-default navbar-top">
				<div class="container">
					<div class="nav-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<a href="../admin/index.php" class="navbar-brand"><img src="../images/site_logo.jpg" alt="BVN LOGO" width="50px" height="50px"></a>

					<div class="collapse navbar-collapse pull-right" id="collapse">
						<ul class="nav navbar-nav">
							<!--menu items-->
							<li><a href="../admin/index.php">Dashboard</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Users<span class="caret"></span></a>

								<ul class="dropdown-menu" role="menu">

									<li><a href="../admin/users_admin.php">All Users</a></li>
									<li><a href="../admin/register_admin.php">Create User</a></li>
									<li><a href="../admin/users_admin.php?Frozen">Frozen Users</a></li>
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?php echo user_name(); ?> <span class="caret"></span></a>

								<ul class="dropdown-menu" role="menu">

									<li><a href="change_password.php">Change Password</a></li>
									<li><a href="../users/logout.php">Logout</a></li>

								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<h1 class="text-center">BVN Admin Panel</h1>
</header>
			