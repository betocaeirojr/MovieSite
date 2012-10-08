<?php
	//connect to MySQL
	$connect = mysql_connect("localhost", "root", "")
		or die("Hey loser, check your server connection.");
	
	//make sure we’re using the right database
	mysql_select_db("moviesite");
	$query = 	"SELECT movie_name, movie_type " .
				"FROM movie " .
				"WHERE movie_year>1990 " .
				"ORDER BY movie_type";
	
	$results = mysql_query($query)
		or die(mysql_error());
	
	// Using While
	//while ($row = mysql_fetch_array($results)) 
	//{
	//	extract($row);
	//	echo $movie_name;
	//	echo " - ";
	//	echo $movie_type;
	//	echo "<br>";
	//}

	while ($row = mysql_fetch_assoc($results))
	{
		foreach ($row as $val1) 
		{
			echo $val1;
			echo " / ";
		}
		echo "<br>"; 
	}
?>