<?php  

	$db = mysqli_connect('127.0.0.1', 'root', '', 'bvn');
	
	session_start();
	
	if (mysqli_connect_errno()) {
		echo "Database connection failed with the following error: ". mysqli_connect_error();
		die();	
	}

	if (isset($_SESSION['user'])) {
		$user_id = $_SESSION['user'];
		$user_query = $db->query("SELECT * FROM user WHERE user_id = '$user_id'");
		$user_data = mysqli_fetch_assoc($user_query);
	}

	if (isset($_SESSION['success_flash'])) {
		echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
		unset($_SESSION['success_flash']);
	}

	if (isset($_SESSION['error_flash'])) {
		echo '<div class="bg-danger"><p class="text-success text-center">'.$_SESSION['error_flash'].'</p></div>';
		unset($_SESSION['error_flash']);
	}

	
