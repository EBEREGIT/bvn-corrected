<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<style type="text/css">
		/*#background{
		    position:absolute;
		    z-index:0;
		    background:white;
		    display:block;
		    min-height:50%; 
		    min-width:50%;
		    color:yellow;
		    background-repeat: repeat;
		    back
		}

		#content{
		    position:absolute;
		    z-index:1;
		}

		#bg-text
		{
		    color:lightgrey;
		    font-size:120px;
		    background-repeat: repeat;
		}*/
	</style>
</head>

<body id="background">
	<!DOCTYPE html>
<html>
<body>

<?php 
	$result = "222";
	$chars = "9876504321123456789";
	$charArray = str_split($chars);
	for($i = 0; $i < 8; $i++){
		$rand_item = array_rand($charArray);
		$result .= "".$charArray[$rand_item];
	}
		echo $result;
?>

</body>
</html>

  </body>
</html>