<?php 
	include_once '../includes/header.php';
	include_once '../includes/header-x.php';

	unset($_SESSION['user']);
	header('Location: ../index.php');
	
	include_once '../includes/footer.php';
?>
