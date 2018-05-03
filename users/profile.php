<?php  
	include_once '../includes/header.php';
	//check if the user is logged in else redirect the user to the login page
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include_once '../includes/header-x.php';
?>

<div class="row faq">
	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 profile-image">
		<a href="#"><img src="../images/1.jpg"></a>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
		<table class="table table-striped">
			<h1>BVN User Profile</h1>
			<thead>
				<th></th>
				<th></th>
			</thead>

			<tbody>
				<tr>
					<td><b>Name</b></td>
					<td><?php echo $user_data['full_name']; ?></td>
				</tr>
				<tr>
					<td><b>Phone Number</b></td>
					<td><?php echo $user_data['phone_number']; ?></td>
				</tr>
				<tr>
					<td><b>Email</b></td>
					<td><?php echo $user_data['email']; ?></td>
				</tr>
				<tr>
					<td><b>BVN</b></td>
					<td><?php echo $user_data['bvn']; ?></td>
				</tr>
			</tbody>
		</table>
			<?php if($user_data['user_role'] != 'user'): ?>
				<a href="../admin/index.php" class="btn btn-default profile-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Go to Admin Panel</a>
			<?php endif; ?>
		<a href="change_password.php" class="btn btn-warning profile-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Change Password</a>
		<a href="logout.php" class="btn btn-danger profile-btn"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> | Logout</a>
	</div>	
</div>

<?php  
	include_once '../includes/footer.php';
?>