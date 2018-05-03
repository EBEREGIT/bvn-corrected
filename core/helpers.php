<?php 
	include_once 'init.php';

	function display_errors($errors)
	{
		$display = '<ul class="bg-danger">';
		foreach ($errors as $error) {
			$display .= '<li class="text-danger">'.$error.'</li>';
		}

		$display .= '</ul>';
		return $display;
	}

	function sanitize($dirty)
	{
		return htmlentities($dirty, ENT_QUOTES, "UTF-8");
	}

	function login($user_id)
	{
		$_SESSION['user'] = $user_id;
		global $db;
		$date = date("Y-m-d H:i:s");
		$db->query("UPDATE user SET last_login = '$date' WHERE user_id = '$user_id'");
		$_SESSION['success_flash'] = "You are now logged in!";

		//redirect user according to user's role
		$user = $db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		$logged_in_user = mysqli_fetch_assoc($user);
		if ($logged_in_user['user_role'] != 'user') {
			header('Location: ../admin/index.php');
		}else{
			header('Location: profile.php');
		}	
	}

	function is_logged_in()
	{
		if (isset($_SESSION['user']) && $_SESSION['user'] > 0) {
			return true;
		}			
		return false;
	}

	function is_admin_logged_in()
	{
		global $db, $user_id;
		$_SESSION['user'] = $user_id;
		if (isset($_SESSION['user']) && $_SESSION['user'] > 0) {
		$user = $db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		$logged_in_user = mysqli_fetch_assoc($user);
		$user_role = $logged_in_user['user_role'];
			if ($user_role != 'user') {
				return true;
			}
				return false;
		}
	}

	function is_editor()
	{
		global $db, $user_id;
		$_SESSION['user'] = $user_id;
		if (isset($_SESSION['user']) && $_SESSION['user'] > 0) {
		$user = $db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		$logged_in_user = mysqli_fetch_assoc($user);
		$user_role = $logged_in_user['user_role'];
			if ($user_role = 'editor') {
				return false;
			}
		}
	}

	function user_name()
	{
		global $db, $user_id;
		$_SESSION['user'] = $user_id;
		$user = $db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		$logged_in_user = mysqli_fetch_assoc($user);
		return $logged_in_user['full_name'];
	}

	function login_error_redirect($url = '../users/login.php')
	{
		$_SESSION['error_flash'] = 'You must be logged in to access that page!';
		header('Location: '.$url);
	}

	function pretty_date($date)
	{
		return date('M, d, Y h:i A', strtotime($date));
	}
?>