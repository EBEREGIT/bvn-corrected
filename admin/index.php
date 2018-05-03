<?php 
	include_once 'includes_admin/header_admin.php';
?>
	<div class="row faq">
	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 profile-image">
		<a href="#"><img src="../images/1.jpg"></a>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
		<table class="table table-striped">
			<h1>User Profile</h1>
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
				<tr>
					<td><b>User Role</b></td>
					<td><?php echo $user_data['user_role']; ?></td>
				</tr>
			</tbody>
		</table>
			<?php if($user_data['user_role'] != 'user'): ?>
				<a href="../index.php" class="btn btn-default profile-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Go to Site</a>
			<?php endif; ?>
		<a href="edit.php" class="btn btn-primary profile-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Edit Profile</a>
		<a href="change_password.php" class="btn btn-warning profile-btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> | Change Password</a>
		<a href="../users/logout.php" class="btn btn-danger profile-btn"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> | Logout</a>
	</div>	
</div>

<?php 
	include_once 'includes_admin/footer_admin.php';
?>