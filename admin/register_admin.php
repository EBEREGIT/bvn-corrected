<?php 
	include_once 'includes_admin/header_admin.php';

	if ($_POST) {
			//check if email, phone number or account number already exists
			user_existence_validation();

			//check if bvn already exists
			$bvn = bvn_validation();
			
			//check if any field is empty
			required_fields_validation();

			//check if password lenght is less than 8 characters
			password_validation();

			//check if account number lenght is 10 characters
			account_number_validation();

			//check if password lenght is less than 8 characters
			phone_number_validation();

			//check if email format is valid
			email_validation();

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
				$_SESSION['success_flash'] = 'User have been registered and assigned a BVN!';
				header('Location: register_admin.php');
			}
		}

?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container-fluid" id="faq">
	<form action="register_admin.php" method="post" enctype="multipart/form-data">
		<h3>Create User</h3><hr>
		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="name"></label>
			<input type="name" class="form-control" name="name" id="name" class="" value="<?php echo $name; ?>" placeholder="Full Name (surname first)">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="name"></label>
			<input type="name" class="form-control" name="account_name" id="name" class="" value="<?php echo $account_name; ?>" placeholder="Account Name">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="number" class="form-control" name="account_number" id="number" class="" value="<?php echo $account_number; ?>" placeholder="Account Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="number" class="form-control" name="phone_number" id="number" class="" value="<?php echo $phone_number; ?>" placeholder="Phone Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="email"></label>
			<input type="email" class="form-control" name="email" id="email" class="" value="<?php echo $email; ?>" placeholder="Email">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="password"></label>
			<input type="password" class="form-control" name="password" id="password" class="" value="<?php echo $hashed_password; ?>" placeholder="Password">
		</div>

		<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label for="photo"></label>
			<input type="file" class="form-control" name="photo" id="photo" class="" value="<?php echo $photo; ?>" placeholder="photo">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="user_role"></label>
			<select class="form-control" name="user_role" >
				<option value="" <?php echo (($user_role == '')?' selected':''); ?>>Select User Role</option>
				<option value="admin" <?php echo (($user_role == 'admin')?' selected':''); ?>>admin</option>
				<option value="editor" <?php echo (($user_role == 'editor')?' selected':''); ?>>editor</option>
				<option value="user" <?php echo (($user_role == 'user')?' selected':''); ?>>user</option>
			</select>
		</div>

		<div class="g-recaptcha form-group col-xs-11 col-sm-11 col-md-11 col-lg-11" data-sitekey="6LdVTkQUAAAAAOdR2cpEgM3l2OB0oURUtBOjNkLt"></div>
	
		<div class="form-group form-group col-xs-1 col-sm-1 col-md-1 col-lg-1" id="buttons">
			<input type="submit" name="submit" value="Create User" class="btn btn-primary">
		</div>
	</form>
</div>


<?php 
	include_once 'includes_admin/footer_admin.php';
?>