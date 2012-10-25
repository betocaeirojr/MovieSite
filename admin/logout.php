<?php
session_start();
session_destroy();
session_unset();
?>
<html>
	<head> 
		<title>Loging Out -- See you soon!</title>
	</head>
	<body>
		<p>You has been logged out</p>
		<p><a href="../index.php">Do you want to return to the non-logged user area?</a></p> 
	</body>
</html>
