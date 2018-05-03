<?php  
	include_once '../includes/header.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include_once '../includes/header-x.php';

	//posted values and values from db
		$name = ((isset($_POST['name']))?sanitize($_POST['name']):sanitize($user_data['full_name']));
		$email = ((isset($_POST['email']))?sanitize($_POST['email']):sanitize($user_data['email']));
		$phone_number = ((isset($_POST['phone_number']))?sanitize($_POST['phone_number']):sanitize($user_data['phone_number']));

	if ($_POST) {
		//check if email already exists
		$email_query = $db->query("SELECT * FROM user WHERE email = '$email' AND user_id != '$user_id'");
		$email_count = mysqli_num_rows($email_query);
		if ($email_count != 0) {
			$errors[] = "Email already exist!";
		}
		
		//check if any field is empty
		$required = array('name', 'email', 'phone_number');
		foreach ($required as $field) {
			if (empty($_POST[$field])) {
				$errors[] = "You must fill out all fields!";
				break;
			}
		}

		//check if email format is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email!";
		}


		if (!empty($errors)) {
			//output error if any
			echo display_errors($errors);
		}else{
			//edit user details
			$db->query("UPDATE user SET full_name = '$name', email = '$email', phone_number = '$phone_number', last_modified = '$date' WHERE user_id = '$user_id'");
			$_SESSION['success_flash'] = 'Details updated successfully!';
			header('Location: profile.php');
		}
	}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 reg" id="login-form">
	<h2 class="text-center">BVN Edit Profile</h2><hr>
	<form action="edit.php" method="post">
		<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<label for="name"></label>
			<input type="name" name="name" id="name" class="" value="<?php echo $name; ?>" placeholder="Full Name (surname first)">
		</div>

		<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<label for="number"></label>
			<input type="number" name="phone_number" id="number" class="" value="<?php echo $phone_number; ?>" placeholder="Phone Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<label for="email"></label>
			<input type="email" name="email" id="email" class="" value="<?php echo $email; ?>" placeholder="Email">
		</div>
	
		<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 id="buttons">
			<input type="submit" name="submit" value="Apply Changes" class="btn btn-primary">
		</div>

		<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 id="buttons">
			<p class="text-right"><a href="faq.php" alt="home">Any Questions?</a></p>
		</div>
	</form>
</div>


<?php  
	include_once '../includes/footer.php';
?>