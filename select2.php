<?php
	$qryOffset = $_REQUEST['offset'];

	//connect to MySQL
	$connect = mysql_connect("localhost", "root", "")
		or die("Hey loser, check your server connection.");
	
	//make sure we’re using the right database
	mysql_select_db("moviesite");
	
	// Prepare Query String Retrieving Movie Name, Genre and Lead Actor
	$query = 	"SELECT " . 
					"M.movie_name as MovieName, "   		.	 
					"T.movietype_label as Genre, " 			.
					"P.people_fullname as LeadActor " 		.
				"FROM " 									.
					"movie M, movietype T, people P " 		.
				"WHERE " 									. 
					"M.movie_type = T.movietype_id AND " 	.
					"M.movie_leadactor = P.people_id " 		. 
				"ORDER BY " 								.
					"M.movie_name";
	$results = mysql_query($query)
		or die(mysql_error());
	
	// Assembling the HTML table
	// Open TABLE tag
	echo "<table border=\"1\">\n";

	// Writing Table Headers
	echo "<tr>\n";
		echo "<th>Movie Name</th>\n";
		echo "<th>Genre</th>\n";
		echo "<th>Lead Actor</th>\n";
	echo "</tr>\n";

	while ($row1 = mysql_fetch_assoc($results)) 
	{
		// Open ROW Tag
		echo "<tr>\n";
		foreach($row1 as $value) 
		{
			// Creating Column tags/values
			echo "<td>\n";
			echo $value;
			// Closing row tags
			echo "</td>\n";
		}
		// closing row tags
		echo "</tr>\n";
	}
	// closing table tags
	echo "</table>\n";

	echo "<BR>";

	// Prepare Query String Retrieving Movie Name, Genre and Director
	$query2 = 	"SELECT " . 
					"M.movie_name as MovieName, "   		.	 
					"T.movietype_label as Genre, " 			.
					"P.people_fullname as Director " 		.
				"FROM " 									.
					"movie M, movietype T, people P " 		.
				"WHERE " 									. 
					"M.movie_type = T.movietype_id AND " 	.
					"M.movie_director = P.people_id " 		. 
				"ORDER BY " 								.
					"M.movie_name";
	$results2 = mysql_query($query2)
		or die(mysql_error());

	// Assembling the HTML table
	// Open TABLE tag
	echo "<table border=\"1\">\n";
	
	// Writing Table Headers
	echo "<tr>\n";
		echo "<th>Movie Name</th>\n";
		echo "<th>Genre</th>\n";
		echo "<th>Director</th>\n";
	echo "</tr>\n";

	while ($row2 = mysql_fetch_assoc($results2)) 
	{
		// Open ROW Tag
		echo "<tr>\n";
		foreach($row2 as $value) 
		{
			// Creating Column tags/values
			echo "<td>\n";
			echo $value;
			// Closing row tags
			echo "</td>\n";
		}
		// closing row tags
		echo "</tr>\n";
	}
	// closing table tags
	echo "</table>\n";


	// Listing only Commedies
	echo "<p>\n";
	echo "Comedies Listed.\n";
	
	// Prepare Query String Retrieving Movie Name, Genre and Director
	$query3 = 	"SELECT " . 
					"movie_name as MovieName, "   	.	 
					"movie_year as MovieYear "		.
				"FROM " 							.
					"movie "						.
				"WHERE " 							. 
					"movie_type = 5 "				.
				"ORDER BY " 						.
					"movie_name";
	$results3 = mysql_query($query3)
		or die(mysql_error());

	// Assembling the HTML table
	// Open TABLE tag
	echo "<table border=\"1\">\n";
	
	// Writing Table Headers
	echo "<tr>\n";
		echo "<th>Movie Name</th>\n";
		echo "<th>Year</th>\n";
	echo "</tr>\n";

	while ($row3 = mysql_fetch_assoc($results3)) 
	{
		// Open ROW Tag
		echo "<tr>\n";
		foreach($row3 as $value) 
		{
			// Creating Column tags/values
			echo "<td>\n";
			echo $value;
			// Closing row tags
			echo "</td>\n";
		}
		// closing row tags
		echo "</tr>\n";
	}
	// closing table tags
	echo "</table>\n";

	echo "</p>";

	// Showing all movies
	// Prepare Query String Retrieving Movie Name, Genre and Director
	$query4 = 	"SELECT " . 
					"movie_name as MovieName "   	.	 
				"FROM " 							.
					"movie "						.
				"ORDER BY " 						.
					"movie_name";
	$results4 = mysql_query($query4)
		or die(mysql_error());

	// Assembling the HTML table
	// Open TABLE tag
	echo "<table border=\"1\">\n";
	
	// Writing Table Headers
	echo "<tr>\n";
		echo "<th>Movie Name</th>\n";
	echo "</tr>\n";

	while ($row4 = mysql_fetch_assoc($results4)) 
	{
		// Open ROW Tag
		echo "<tr>\n";
		foreach($row4 as $value) 
		{
			// Creating Column tags/values
			echo "<td>\n";
			echo $value;
			// Closing row tags
			echo "</td>\n";
		}
		// closing row tags
		echo "</tr>\n";
	}
	// closing table tags
	echo "</table>\n";

	echo "</p>";
	// Paginating
	/*
	if (isset($qryOffset) ==  true) 
	{
		echo "<BR> The offset is: $qryOffset <BR>";
	} else
	{
		$qryOffset = 0;
	}

	$query5 = 	"SELECT " . 
					"movie_name  "   	.	 
				"FROM " 				.
					"movie "			.
				"ORDER BY " 			.
					"movie_name "		.
				"LIMIT " . $qryOffset . ",1";

	echo "<p>$query5</p>\n";

	$results5 = mysql_query($query5)
		or die(mysql_error());

	echo "<p>\n";

	$row5 = mysql_fetch_array($results5));
	extract($row5);
	echo "<p>$movie_name</p>";


	//
	$queryCount = "SELECT "             				. 
					"count (movie_name) as MaxOffset"   .	 
				"FROM " 								.
					"movie "							.
				"ORDER BY " 							.
					"movie_name";

	$resultsCount = mysql_query($queryCount)
		or die (mysql_error());

	echo "<BR>". $queryCount . "<BR>" ; 
					
	
	//$rowCount = mysql_fetch_array($resultsCount));
	//extract($rowCount);
	//echo $MaxOffset;
	

	//if ($qryOffset != 0)
	//{
		//echo "<>See Previous<>";
		
		//echo "<BR>";
	//}

		
	echo "<>See Next";
	*/
?>