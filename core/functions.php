<?php
	include_once 'helpers.php';
	include_once 'validate.php';

		$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
		$name = trim($name);
		$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
		$email = trim($email);
		$phone_number = ((isset($_POST['phone_number']))?sanitize($_POST['phone_number']):'');
		$phone_number = trim($phone_number);
		$account_name = ((isset($_POST['account_name']))?sanitize($_POST['account_name']):'');
		$account_name = trim($account_name);
		$account_number = ((isset($_POST['account_number']))?sanitize($_POST['account_number']):'');
		$account_number = trim($account_number);
		$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
		$password = trim($password);
		$hashed_password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
		$hashed_password = trim($hashed_password);
		$errors = array();
		$confirm_password = ((isset($_POST['confirm_password']))?sanitize($_POST['confirm_password']):'');
		$confirm_password = trim($confirm_password);
		$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
		$old_password = trim($old_password);
		$user_role = ((isset($_POST['user_role']))?sanitize($_POST['user_role']):'');
		$user_role = trim($user_role);
		$search_user = ((isset($_POST['search_user']))?sanitize($_POST['search_user']):'');
		$search_user = trim($search_user);
		$photo = ((isset($_POST['photo']))?sanitize($_POST['photo']):'');
		$photo = trim($photo);
		$date = date("Y-m-d H:i:s");

		function random_bvn($len)
		{
			$result = "222";
			$chars = "9876504321123456789";
			$charArray = str_split($chars);
			for($i = 0; $i < $len; $i++){
				$rand_item = array_rand($charArray);
				$result .= "".$charArray[$rand_item];
			}
			return $result;
		}
		
?>