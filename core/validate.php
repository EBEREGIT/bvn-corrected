<?php
	include_once 'init.php';
	function user_existence_validation()
		{
			//check if email, phone number or account number already exists
			global $db, $email, $phone_number, $account_number, $errors;
			$email_query = $db->query("SELECT * FROM user WHERE email = '$email' || phone_number = '$phone_number' || account_number = '$account_number'");
			$email_count = mysqli_num_rows($email_query);
			if ($email_count != 0) {
				$errors[] = "Email, Phone Number or Account Number already exist!";
			}
			return $errors;
		}

	function user_existence_check($edit_id)
		{
			//check if email, phone number or account number already exists
			global $db, $email, $phone_number, $account_number, $errors;
			$email_query = $db->query("SELECT * FROM user WHERE email = '$email' AND user_id != '$edit_id' || phone_number = '$phone_number' AND user_id != '$edit_id' || account_number = '$account_number' AND user_id != '$edit_id'");
			$email_count = mysqli_num_rows($email_query);
			if ($email_count != 0) {
				$errors[] = "Email, Phone Number or Account Number already exist!";
			}
			return $errors;
		}


	function bvn_validation()
	{
		//check if bvn already exists
		global $db;
		$bvn = 0;		
		$bvn_count = 0;
		do {
			$bvn += random_bvn(8);
			$bvn_query = $db->query("SELECT * FROM user WHERE bvn = '$bvn'");
			$bvn_count += mysqli_num_rows($bvn_query);
		} while ($bvn_count != 0);
		return $bvn;
	}

	function required_fields_validation()
	{
		//check if any field is empty
		global $errors;
		$required = array('name','account_number', 'account_name', 'email', 'phone_number');
		foreach ($required as $field) {
			if (empty($_POST[$field])) {
				$errors[] = "You must fill out all fields!";
				break;
			}
		}
		return $errors;
	}

	function password_validation()
	{
		//check if password lenght is less than 8 characters
		global $errors, $password;
		if (strlen($password) < 8) {
			$errors[] = "Password cannot be less than 8 characters!";
		}
		return $errors;
	}

	function account_number_validation()
	{
		//check if account number lenght is 10 characters
		global $errors, $account_number;
		if (strlen($account_number) != 10) {
			$errors[] = "Account Number must be 10 characters!";
		}
		return $errors;
	}

	function phone_number_validation()
	{
		//check if password lenght is less than 8 characters
		global $errors, $phone_number;
		if (strlen($phone_number) != 10 && strlen($phone_number) != 13) {
			$errors[] = "Invalid Phone Number!";
		}
		return $errors;
	}

	function email_validation()
	{
		//check if email format is valid
		global $errors, $email;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email!";
		}
		return $errors;
	}

	function user_login_check()
	{
		//check if email exists in the database
		global $errors, $db, $email;
		$email_query = $db->query("SELECT * FROM user WHERE email = '$email'");
		$email_count = mysqli_num_rows($email_query);
		if ($email_count != 1) {
			$errors[] = "User do not exist!";
		}

	}

	function password_match_check()
	{
		global $errors, $db, $email, $password;
		$email_query = $db->query("SELECT * FROM user WHERE email = '$email'");
		$user_array = mysqli_fetch_assoc($email_query);
		if (!password_verify($password, $user_array['password'])) {
				$errors[] = "Password Mismatch!";
			}

	}

	function empty_fields_check()
	{
		//check if all fields are filled out
		global $errors;
		if (empty($_POST['email']) || empty($_POST['password'])) {
			$errors[] = "Please fill out all fields!";
		}
		return $errors;
	}
?>