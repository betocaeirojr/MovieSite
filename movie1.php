<?php
	session_start();
	// Iniciando Controle de Sessao
	$_SESSION['username']  = $_POST['user'];
	$_SESSION['userpass']  = $_POST['pass'] ;
	$_SESSION['authuser']  = 0;


    // Check username and password information
    if (($_SESSION['username'] == 'Joe') and
        ($_SESSION['userpass'] == '12345'))
    {
    	if ($_SESSION['activedebug']) 
    	{
    		print "<BR>Estou passando aqui???<BR>";
    	}
   
    	$_SESSION['authuser'] = 1;

    } else 
    {
        // User not passed Authentication
        echo "Sorry, but you are not allowed to view this page!";
        exit();
    }

?>		
<html>
	<head>
		<title>Find my Favorite Movie!</title>
	</head>
	<body>
		<?php include "header.php"; ?>
		<?php
			$myfavmovie = urlencode("Life of Brien");
			// Favorite Movie = Life of Brien
			echo "<a href='moviesite.php?favmovie=$myfavmovie'>";
			echo "Click here to see information about my favorite movie!";
			echo "</a><BR>";
			echo "<br>";
			
			// Top 10 movies
			//echo "<a href='moviesite.php'>";
			//echo "Click here to see my top 10 movies.";
			//echo "</a>";

			//echo "<br>";
			
			// Top 10 movies sorted
			//echo "<a href='moviesite.php?sorted=true'>";
			//echo "Click here to see my top 10 movies, sorted alphabetically!";
			//echo "</a>";

			echo "Or choose how many movies you would like to see:";
			echo "</a>";
			echo "<br>";
		?>
		<form method="post" action="moviesite.php">
			<p>Enter number of movies (up to 10):
			<input type="text" name="num">
			<br>
			Check here if you want the list sorted alphabetically:
			<input type="checkbox" name="sorted">
			</p>	
			<input type="submit" name="Submit" value="Submit">
		</form>

		<?php
			if ($_SESSION['activedebug'])
			{
				print $myfavmovie;
				print "<BR>";
				print $_SESSION['username'].' '.$_SESSION['userpass'].' '.$_SESSION['authuser'];
			}
		?>
		<?php include "footer.php"; ?>
	</body>
</html>