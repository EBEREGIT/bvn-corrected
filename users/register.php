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

		//verify the account number
		// if (strlen($account_number) != 10) {
		// 	$errors[] = "Account Number must be 10 characters!";
		// }

		//verify the phone number
		if (strlen($phone_number) != 11 && strlen($phone_number) != 13) {
			$errors[] = "Invalid Phone Number!";
		}

		//check if email format is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email!";
		}

		//verify uploaded image
		if (!empty($_FILES)) {
			$photo = $_FILES['photo'];
			$photo_name = $photo['name'];
			$name_array = explode('.', $photo_name);
			$file_name = $name_array[0];
			$file_extension = $name_array[1];
			$mime = explode('/', $photo['type']);
			$mime_type = $mime[0];
			$mime_extension = $mime[1];
			$temp_location = $photo['tmp_name'];
			$file_size = $photo['size'];
			$allowed = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF');
			$upload_name = md5(microtime()).'.'.$file_extension;
			$upload_path = '../images/'.$upload_name;
			$db_path = '/bvn-master/images/'.$upload_name;
			
			if ($mime_type != 'image') {
				$errors[] = 'File must be a photo';
			}
			if (!in_array($file_extension, $allowed)) {
				$errors[] = 'Wrong image file extension';  
			}
			if ($file_size > 1000000) {
				$errors[] = 'File should not be more than 1MB';
			}
		}

		if (!empty($errors)) {
			//output error if any
			echo display_errors($errors);
		}else{
			//upload file and update db
			if (!empty($_FILES)) {
				move_uploaded_file($temp_location, $upload_path);
			}
			//encrypt the password
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			//add user to db and assign bvn
			$user_role = "user";
			$db->query("INSERT INTO user (full_name, phone_number, bvn, email, password, user_role, account_number, account_name, passport) 
				VALUES ('$name', '$phone_number', '$bvn', '$email', '$hashed_password', '$user_role', '$account_number', '$account_name', '$db_path')");

			//read from user table
			$account_query = $db->query("SELECT * FROM user WHERE bvn = $bvn");
			$account_array = mysqli_fetch_assoc($account_query);
			$account_id = $account_array['user_id'];

			//insert into account_numbers table
			$account_number_array = explode(" ", $account_number);
			foreach ($account_number_array as $accounts) {
				$db->query("INSERT INTO account_numbers(account_id, account_number) VALUES('$account_id', '$accounts')");
			}
			
			//display success message
			$_SESSION['success_flash'] = 'You have been registered and assigned a BVN. Login to see!';
			header('Location: login.php');
		}
	}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 reg faq" id="faq">
	<h2 class="text-center">BVN User Registeration</h2><hr>

	<!-- registration form -->
	<form action="register.php" method="post" enctype="multipart/form-data">
		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="name"></label>
			<input type="name" name="name" id="name" class="" title="Please Enter Full Name (surname first) Here" value="<?php echo $name; ?>" placeholder="Full Name (surname first)">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="name"></label>
			<input type="name" name="account_name" id="name" class="" title="Please Account Name Here" value="<?php echo $account_name; ?>" placeholder="Account Name">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="name" name="account_number" id="number" class="" title="Please Account Number Here" value="<?php echo $account_number; ?>" placeholder="Account Number(s) split by space">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="number" name="phone_number" id="number" class="" title="Please Phone Number Here" value="<?php echo $phone_number; ?>" placeholder="Phone Number">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="email"></label>
			<input type="email" name="email" id="email" class="" value="<?php echo $email; ?>" placeholder="Email">
		</div>

		<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label for="password"></label>
			<input type="password" name="password" id="password" class="" value="<?php echo $hashed_password; ?>" placeholder="Password">
		</div>

		<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label for="photo">Passport</label>
			<input type="file" name="photo" id="photo" class="" value="<?php echo $photo; ?>" placeholder="photo">
		</div>

		<div>
			<p class="text-right"><a href="faq.php" alt="home">Any Questions?</a></p>
		</div>

	
		<div class="form-group " id="buttons">
			<!-- <div class="g-recaptcha" data-sitekey="6LdVTkQUAAAAAOdR2cpEgM3l2OB0oURUtBOjNkLt"><br></div> -->
			<input type="submit" name="submit" value="Give Me Access" class="btn btn-primary">
		</div>
	</form>
</div>


<?php  
	include_once '../includes/footer.php';
?>