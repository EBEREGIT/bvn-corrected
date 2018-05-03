<?php  
	include_once '../includes/header.php';
	//check if the user is logged in else redirect the user to the login page
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include_once '../includes/header-x.php';

	//get user info from db
	$user_id = $user_data['user_id'];
	$hashed_password = $user_data['password'];

	if ($_POST) {
		//check if all fields are filled out
		if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
			$errors[] = "Please fill out all fields!";
		}

		//check if password lenght is less than 8 characters
		if (strlen($password) < 8) {
			$errors[] = "Password cannot be less than 8 characters!";
		}

		//if new password is equal to confirm password
		if ($password != $confirm_password) {
			$errors[] = "Please confirm the new password correctly!";
		}

		if (!password_verify($old_password, $hashed_password)) {
			$errors[] = "Password Mismatch!";
		}

		if (!empty($errors)) {
			//display errors if any
			echo display_errors($errors);
		}else{
			//encrypt the new password
			$new_hashed_password = password_hash($password, PASSWORD_DEFAULT);
			//change user password
			$db->query("UPDATE user SET password = '$new_hashed_password' WHERE user_id = '$user_id'");
			$_SESSION['success_flash'] = "Password Changed Successfully!";
			header('Location: user.php');
		}
	}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 login" id="login-form">
	<h2 class="text-center">BVN Change Password</h2><hr>
	<form action="change_password.php" method="post">
		<div class="form-group">
			<label for="old_password"></label>
			<input type="password" name="old_password" id="old_password" class="" value="<?php echo $old_password; ?>" placeholder="old_password">
		</div>

		<div class="form-group">
			<label for="password"></label>
			<input type="password" name="password" id="password" class="" value="<?php echo $password; ?>" placeholder="Password">
		</div>

		<div class="form-group">
			<label for="confirm_password"></label>
			<input type="password" name="confirm_password" id="confirm_password" class="" value="<?php echo $confirm_password; ?>" placeholder="Confirm New Password">
		</div>
	
		<div class="form-group " id="buttons">
			<a href="user.php" class="btn btn-default">Cancel</a>
			<input type="submit" value="Change My Password" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="#faq.php" alt="home">Any Questions?</a></p>
</div>


<?php  
	include_once '../includes/footer.php';
?>