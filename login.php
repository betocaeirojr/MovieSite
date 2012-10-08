<?php
	session_unset();
	session_start();
	// Recupera via GET se Debug mode está ON or OFF 
    $DebugMode = $_REQUEST['activedebug'];
    $_SESSION['activedebug'] = $DebugMode;
?>
<html>
<head>
	<title>Please, Log In </title>
</head>

<body>
	<?php include "header.php"; ?>
	<form method="post" action="movie1.php">
		<p>Enter your Username: 
			<input type="text" name="user">
		</p>
		<p>Enter your Password:
			<input type="password" name="pass">				
		</p>
		<p>
			<input type="submit" name="Submit" value="Submit">
		</p>
		<?php
			// Inicia trace se DebugMode == TRUE
			if ($DebugMode == true)
			{
				print "Debug Mode On/";
				print $_SESSION['activedebug'];
			} else
			{
				print "Debug Mode Off";
			}
			
		?>
	</form>
	<?php include "footer.php"; ?>
</body>
</html>