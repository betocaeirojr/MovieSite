<?php
	session_start();
	// Check to see if the user has logged with a valid user/passwd
	if ($_SESSION['authuser'] != 1)
	{
			// print $_SESSION['username'];
			echo "Sorry but you are not allowed to see this page.";
			exit();
	}
?>

<html>
<head>
	<title>My Movie Site - <?php echo $_REQUEST['favmovie']; ?></title>
</head>
<body>
	<?php include "header.php"; ?>
	<?php

		$favmovies = array( "Life of Brian",
							"Stripes",
							"Office Space",
							"The Holy Grail",
							"Matrix",
							"Terminator 2",
							"Star Wars",
							"Close Encounters of the Third Kind",
							"Sixteen Candles",
							"Caddyshack");

		if (isset($_REQUEST['favmovie'])) 
		{
			echo "Welcome to our site, ";
			echo $_SESSION['username'];
			echo "! <BR><BR>";
			echo "My favorite movie is ";
			echo $_REQUEST['favmovie'];
			echo "<BR>";
			$movierate = 5;
			echo "My rate for this movie is ";
			echo $movierate;
		} else
		{
			// Retrieve the number of top movies to show from request (post)
			echo "My top 10 ". $_POST['num']." movies are: <br>";
			if (isset($_REQUEST['sorted']))
			{
				sort($favmovies);
			}
			//list the movies
			$numlist = 1;
			while ($numlist <= $_POST['num']) 
			{
				echo $numlist;
				echo ". ";
				echo pos($favmovies);
				next($favmovies);
				echo "<br>\n";
				$numlist = $numlist + 1;
			}

			//foreach ($favmovies as $currentvalue)
			//{
			//	echo $currentvalue;
			//	echo "<br>\n";
			//}	

		} 
		/* Old example code
 		$bobsmovierate = 5;
		$joesmovierate = 7;
		$grahamsmovierate = 2;
		$zabbysmovierate = 1;
		$avgmovierate = (($bobsmovierate + $joesmovierate + $grahamsmovierate
						+ $zabbysmovierate) / 4);
		echo "<BR>";
		echo "The average movie rating for this movie is: ";
		echo $avgmovierate;
		*/
	?>
	<?php include "footer.php"; ?>
</body>
</html>