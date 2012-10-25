<?php
	session_unset();
	session_start();
	// Recupera via GET se Debug mode está ON or OFF 
    //$DebugMode = $_REQUEST['activedebug'];
    //$_SESSION['activedebug'] = $DebugMode;
?>
<html>
<head>
	<title>Please, Log In </title>
</head>

<body>
	<?php include "../header.php"; ?>
	<form method="post" action="authenticate_user.php">
		<!-- Inserting Validation Code From Chapter 8 -->
		
		<p>Enter your Username: 
			<input type="text" name="username">
		</p>
		<p>Enter your Password:
			<input type="password" name="userpass">				
		</p>
		<p>
			<input type="submit" name="Submit" value="Submit">
		</p>
		<p>
		<?php
			if (!empty($_GET['error'])) { 
				echo "<div align=\"center\" " . 
				"style=\"color:#FFFFFF;background-color:#FF0000;" .
				"font-weight:bold\">" . nl2br(urldecode($_GET['error'])) .
				"</div><br>";
			}
		?>


		</p>

		<!--?php
			// Inicia trace se DebugMode == TRUE
			//if ($DebugMode == true)
			//{
			//	print "Debug Mode On/";
			//	print $_SESSION['activedebug'];
			//} else
			//{
			//	print "Debug Mode Off";
			//}
			
		?-->
	</form>
	<?php include "../footer.php"; ?>
</body>
</html>