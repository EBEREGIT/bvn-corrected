<!DOCTYPE html>
<html>
<head>
	<title>Home | BVN</title>
	<link rel="icon" type="image/jpg" href="images/site_logo.jpg">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bvn.css">
</head>
<body id="main" class="main-wrapper">
	<header>
		<div class="row container-fluid">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
				<h2 class="hidden-xs hidden-sm"><a href="index.php"><img src="images/site_logo.jpg" alt="BVN LOGO" width="35px" height="35px"> <span style="color: #000080;">|</span> Bank Verification Number</a></h2>
				<a href="index.php" class="navbar-brand hidden-md hidden-lg"><img src="images/site_logo.jpg" alt="BVN LOGO" width="35px" height="35px"></a>
			</div>

			<!--menu toggle-->
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 menu" id="menu">
				<h2><span class="hidden-xs hidden-sm hidden-md" style="cursor:pointer" onclick="openNav()">&#9776; <span style="color: #000080;">|</span> Menu Bar</span></h2>
				<h2><span class="hidden-lg" style="cursor:pointer" onclick="openNav()">&#9776; </span></h2>
			</div>
		</div>
	</header>


	<!--menu bar-->
	<aside id="mySidenav" class="sidenav">
		<ul>
			<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> | Home</a></li>
			<li><a href="users/login.php"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> | Login</a></li>
			<li><a href="users/register.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Register</a></li>
			<li><a href="users/profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> | User Profile</a></li>
			<li><a href="users/faq.php"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> | FAQ</a></li>
			<li><a href="users/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> | Logout</a></li>
			<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> | Close Menu</a></li>
		</ul>		  
	</aside>


<footer>
	<div class="row container-fluid">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p>&copy;copywrite 2018 Njoku Samson Ebere | 2014/193780. B.Sc Project
				<a href="#"><img src="images/facebook.png"></a>
            	<a href="#"><img src="images/twitter.png"></a>
            	<a href="#"><img src="images/google-plus.png"></a>
          </p>
		</div>
	</div>
</footer>

<!--js files-->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
	<script>
		function openNav() {
		    document.getElementById("mySidenav").style.width = "250px";
		    document.getElementById("main").style.marginRight = "250px";
		}

		function closeNav() {
		    document.getElementById("mySidenav").style.width = "0";
		    document.getElementById("main").style.marginRight= "0";
		}
	</script>

</body>
</html>