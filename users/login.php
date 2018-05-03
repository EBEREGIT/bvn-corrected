<?php  
	include_once '../includes/header.php';
	include_once '../includes/header-x.php';

	if ($_POST) {
		//check if all fields are filled out
		if (empty($_POST['email']) || empty($_POST['password'])) {
			$errors[] = "Please fill out all fields!";
		}

		//check if email format is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email!";
		}

		//check if password lenght is less than 8 characters
		if (strlen($password) < 8) {
			$errors[] = "Password cannot be less than 8 characters!";
		}

		//check if email exists in the database
		$email_query = $db->query("SELECT * FROM user WHERE email = '$email'");
		$user_array = mysqli_fetch_assoc($email_query);
		$email_count = mysqli_num_rows($email_query);
		if ($email_count != 1) {
			$errors[] = "User do not exist!";
		}

		//check if password matches the database record
		if (!password_verify($password, $user_array['password'])) {
			$errors[] = "Password Mismatch!";
		}

		if (!empty($errors)) {
			//display errors if any
			echo display_errors($errors);
		}else{
			//log user in
			$user_id = $user_array['user_id'];
			login($user_id);
		}
	}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 login" id="login-form">
	<h2 class="text-center">BVN Login</h2><hr>
	<form action="login.php" method="post">
		<div class="form-group">
			<label for="email"></label>
			<input type="email" name="email" id="email" class="" value="<?php echo $email; ?>" placeholder="Email">
		</div>

		<div class="form-group">
			<label for="password"></label>
			<input type="password" name="password" id="password" class="" value="<?php echo $password; ?>" placeholder="Password">
		</div>

		<div class="g-recaptcha" data-sitekey="6LdVTkQUAAAAAOdR2cpEgM3l2OB0oURUtBOjNkLt"></div>
		
		<div class="form-group " id="buttons">
			<input type="submit" value="Let Me In" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="faq.php" alt="home">Any Questions?</a></p>
</div>


<?php  
	include_once '../includes/footer.php';
?>