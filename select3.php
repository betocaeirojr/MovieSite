<?php
	$qryOffset = $_REQUEST['offset'];

	//connect to MySQL
	$connect = mysql_connect("localhost", "root", "")
		or die("Hey loser, check your server connection.");
	
	//make sure we’re using the right database
	mysql_select_db("moviesite");
	

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

	// /////////////////////////////////////////
	// closing table tags
	// Paginating
	if (isset($qryOffset) !=  true) 
	{
		$qryOffset = 0;
		
	}
	//print "<BR> The offset is: $qryOffset <BR>";

	$query5 = 	"SELECT " . 
					"movie_name  "   	.	 
				"FROM " 				.
					"movie "			.
				"ORDER BY " 			.
					"movie_name "		.
				"LIMIT " . $qryOffset . ",1";
	// print "<p>$query5</p>\n";

	$results5 = mysql_query($query5)
		or die(mysql_error());

	while ($row5 = mysql_fetch_array($results5))
	{
		extract($row5);
		echo "<p>$movie_name</p>";
	}

	// Determining the Max Number to paginate
	$queryCount = "SELECT "             				. 
					"count(movie_name) as MaxOffset "  .	 
				"FROM " 								.
					"movie "							.
				"ORDER BY " 							.
					"movie_name";
	//print "<BR>". $queryCount . "<BR>" ; 
	
	$resultsCount = mysql_query($queryCount)
		or die (mysql_error());

	while ($rowCount = mysql_fetch_array($resultsCount))
	{
		echo ""; //$rowCount[0];
		echo "<BR>" ; //. $rowCount[0] . "<BR>";
		break;
	}
	$MaxCount = $rowCount ;
	//print "<BR> Maximum Offset - MySQL: ". $rowCount[0] ;
	//print "<BR> Variable Offset: " . $MaxCount[0] ;

	list($mOffset) = $MaxCount;
	//$mOffset = array_values($MaxCount[0]);
	//print "<BR>". $mOffset; 				
	
	echo "<p>\n";

	// Links de Próximo & Anterior
	if ($qryOffset != 0) 
	{
		echo "<a href=select3.php?offset=";
		echo $qryOffset-1;
		echo ">See Previous</a>  || ";
	}
	echo "This is page " . ($qryOffset + 1) . " ";
	
	if ($qryOffset < ($mOffset - 1)) 
	{
		echo " || <a href=select3.php?offset=";
		echo $qryOffset+1;
		echo ">See Next</a> <BR>";
	}
	echo "</p>\n";
?>