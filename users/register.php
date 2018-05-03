<?php  
	include_once '../includes/header.php';
	include_once '../includes/header-x.php';

	if ($_POST) {
		//check if email already exists
		$email_query = $db->query("SELECT * FROM user WHERE email = '$email' || phone_number = '$phone_number' || account_number = '$account_number'");
		$email_count = mysqli_num_rows($email_query);
		if ($email_count != 0) {
			$errors[] = "Email, Phone Number or Account Number already exist!";
		}

		//check if bvn already exists
		$bvn = 0;		
		$bvn_count = 0;
		do {
			$bvn += random_bvn(8);
			$bvn_query = $db->query("SELECT * FROM user WHERE bvn = '$bvn'");
			$bvn_count += mysqli_num_rows($bvn_query);
		} while ($bvn_count != 0);
		
		//check if any field is empty
		$required = array('name','account_number', 'account_name', 'email', 'phone_number', 'password');
		foreach ($required as $field) {
			if (empty($_POST[$field])) {
				$errors[] = "You must fill out all fields!";
				break;
			}
		}

		//check if password lenght is less than 8 characters
		if (strlen($password) < 8) {
			$errors[] = "Password cannot be less than 8 characters!";
		}

		//check if email format is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email!";
		}


		if (!empty($errors)) {
			//output error if any
			echo display_errors($errors);
		}else{
			//encrypt the password
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			//add user to db and assign bvn
			$user_role = "user";
			$db->query("INSERT INTO user (full_name, phone_number, bvn, email, password, user_role, account_number, account_name) 
				VALUES ('$name', '$phone_number', '$bvn', '$email', '$hashed_password', '$user_role', '$account_number', '$account_name')");
			$_SESSION['success_flash'] = 'You have been registered and assigned a BVN. Login to see!';
			header('Location: login.php');
		}
	}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 reg faq" id="faq">
	<h2 class="text-center">BVN User Registeration</h2><hr>
	<form action="register.php" method="post">
		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="name"></label>
			<input type="name" name="name" id="name" class="" value="<?php echo $name; ?>" placeholder="Full Name (surname first)">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="name"></label>
			<input type="name" name="account_name" id="name" class="" value="<?php echo $account_name; ?>" placeholder="Account Name">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="number" name="account_number" id="number" class="" value="<?php echo $account_number; ?>" placeholder="Account Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="number" name="phone_number" id="number" class="" value="<?php echo $phone_number; ?>" placeholder="Phone Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="email"></label>
			<input type="email" name="email" id="email" class="" value="<?php echo $email; ?>" placeholder="Email">
		</div>

		<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label for="password"></label>
			<input type="password" name="password" id="password" class="" value="<?php echo $hashed_password; ?>" placeholder="Password">
		</div>

		<div>
			<p class="text-right"><a href="#faq.php" alt="home">Any Questions?</a></p>
		</div>

	
		<div class="form-group " id="buttons">
			<div class="g-recaptcha" data-sitekey="6LdVTkQUAAAAAOdR2cpEgM3l2OB0oURUtBOjNkLt"></div>
			<input type="submit" name="submit" value="Give Me Access" class="btn btn-primary">
		</div>
	</form>
</div>


<?php  
	include_once '../includes/footer.php';
?>