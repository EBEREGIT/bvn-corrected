<?php 
	include_once 'includes_admin/header_admin.php';

	if (isset($_GET['edit'])) {
			$edit_id = (int)$_GET['edit'];
			$edit_id = sanitize($edit_id);
			$edit_query = $db->query("SELECT * FROM user WHERE user_id = '$edit_id'");
			$edit = mysqli_fetch_assoc($edit_query);	

			//posted values and values from db
			$name = ((isset($_POST['name']))?sanitize($_POST['name']):sanitize($edit['full_name']));
			$email = ((isset($_POST['email']))?sanitize($_POST['email']):sanitize($edit['email']));
			$account_name = ((isset($_POST['account_name']))?sanitize($_POST['account_name']):sanitize($edit['account_name']));
			$account_number = ((isset($_POST['account_number']))?sanitize($_POST['account_number']):sanitize($edit['account_number']));
			$phone_number = ((isset($_POST['phone_number']))?sanitize($_POST['phone_number']):sanitize($edit['phone_number']));
			$user_role = ((isset($_POST['user_role']))?sanitize($_POST['user_role']):sanitize($edit['user_role']));


		if ($_POST) {
				//check if email, phone number or account number already exists
				user_existence_check($edit_id);

				//check if any field is empty
				required_fields_validation();

				//check if account number lenght is 10 characters
				// account_number_validation();

				//check if password lenght is less than 8 characters
				phone_number_validation();

				//check if email format is valid
				email_validation();

				//verify uploaded image
				// if (!empty($_FILES)) {
				// 	$photo = $_FILES['photo'];
				// 	$photo_name = $photo['name'];
				// 	$name_array = explode('.', $photo_name);
				// 	$file_name = $name_array[0];
				// 	$file_extension = $name_array[1];
				// 	$mime = explode('/', $photo['type']);
				// 	$mime_type = $mime[0];
				// 	$mime_extension = $mime[1];
				// 	$temp_location = $photo['tmp_name'];
				// 	$file_size = $photo['size'];
				// 	$allowed = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF');
				// 	$upload_name = md5(microtime()).'.'.$file_extension;
				// 	$upload_path = '../images/'.$upload_name;
				// 	$db_path = '/bvn-master/images/'.$upload_name;
					
				// 	if ($mime_type != 'image') {
				// 		$errors[] = 'File must be a photo';
				// 	}
				// 	if (!in_array($file_extension, $allowed)) {
				// 		$errors[] = 'Wrong image file extension';  
				// 	}
				// 	if ($file_size > 1000000) {
				// 		$errors[] = 'File should not be more than 1MB';
				// 	}
				// }

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
					$db->query("UPDATE user SET full_name = '$name', email = '$email', account_name = '$account_name', account_number = '$account_number', phone_number = '$phone_number', last_modified = '$date', user_role = '$user_role' WHERE user_id = '$edit_id'");
					$_SESSION['success_flash'] = 'User have been updated!';
					header('Location: users_admin.php');
				}
			}
		}

?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container-fluid" id="faq">
	<form action="users_admin.php?edit=<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data">
		<h3>Edit User</h3><hr>
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
			<input type="text" class="form-control" name="account_number" id="number" class="" value="<?php echo $account_number; ?>" placeholder="Account Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="number"></label>
			<input type="text" class="form-control" name="phone_number" id="number" class="" value="<?php echo $phone_number; ?>" placeholder="Phone Number" max-lenght="11" min="0">
		</div>

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="email"></label>
			<input type="email" class="form-control" name="email" id="email" class="" value="<?php echo $email; ?>" placeholder="Email">
		</div>

		<!-- <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<label for="photo"></label>
			<input type="file" class="form-control" name="photo" id="photo" class="" value="<?php echo $db_path; ?>" placeholder="photo">
		</div> -->

		<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
			<label for="user_role"></label>
			<select class="form-control" name="user_role" >
				<option value="" <?php echo (($user_role == '')?' selected':''); ?>>Select User Role</option>
				<option value="admin" <?php echo (($user_role == 'admin')?' selected':''); ?>>admin</option>
				<option value="editor" <?php echo (($user_role == 'editor')?' selected':''); ?>>editor</option>
				<option value="user" <?php echo (($user_role == 'user')?' selected':''); ?>>user</option>
			</select>
		</div>

		<!-- <div class="g-recaptcha form-group col-xs-11 col-sm-11 col-md-11 col-lg-11" data-sitekey="6LdVTkQUAAAAAOdR2cpEgM3l2OB0oURUtBOjNkLt"></div> -->
	
		<div class="form-group form-group col-xs-1 col-sm-1 col-md-1 col-lg-1" id="buttons">
			<input type="submit" name="submit" value="Apply Changes" class="btn btn-primary">
		</div>
	</form>
</div>


<?php 
	include_once 'includes_admin/footer_admin.php';
?>