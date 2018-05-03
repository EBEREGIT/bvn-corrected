<header>
		<div class="row container-fluid" >
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				
					<a href="../index.php" class="navbar-brand"><img src="../images/site_logo.jpg" alt="BVN LOGO" width="35px" height="35px"></a>
		
			</div>

			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 menu" id="menu">
				<!--menu toggle-->
				<h2><span class="hidden-xs hidden-sm hidden-md" style="cursor:pointer" onclick="openNav()">&#9776; Menu Bar</span></h2>
				<h2><span class="hidden-lg" style="cursor:pointer" onclick="openNav()">&#9776; </span></h2>
			</div>
		</div>
	</header>

	<!--side menu-->
	<aside id="mySidenav" class="sidenav">
		<ul>
			<li><a href="../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> | Home</a></li>
			<li><a href="faq.php"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> | FAQ</a></li>
			<?php if (!is_logged_in()) : ?>
				<li><a href="login.php"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> | Login</a></li>
				<li><a href="register.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Register</a></li>
			<?php else : ?>
				<li><a href="profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> | User Profile</a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> | Logout</a></li>
			<?php endif; ?>
			
			
			<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> | Close Menu</a></li>
		</ul>
	</aside>
