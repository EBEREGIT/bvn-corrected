<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

	<form>
		<input type="text" name="">
		<div class="g-recaptcha" data-sitekey="6LdVTkQUAAAAAOdR2cpEgM3l2OB0oURUtBOjNkLt"></div>
		<input type="submit" name="">
	</form>
	<?php
		if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
			var_dump($_POST);
		}
	?>

</body>
</html>