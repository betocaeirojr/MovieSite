<?php
include "admin/connect_to_db.php";

// Preparing the SQL Statement
$query = 	"SELECT movie_id, movie_name, movie_director, movie_leadactor, movie_year " .
			"FROM movie";

// Run the Query
$result = mysql_query($query)
	or die(mysql_error());

// Count the Result
$num_movies = mysql_num_rows($result);

$movie_header =<<<EOD
	<html>
	<head><title>Movie Review Portal</title></head>
	<body>
	<h1><center>Welcome to our Movie Review Portal </center></h1>
	<h2><center>Please check our database below</center></h2>
	<table width="70%" border="1" cellpadding="2" cellspacing="2" align="center">
		<tr bgcolor="lightgrey">
		<th>Movie Title</th>
		<th>Movie Director</th>
		<th>Movie Lead Actor</th>
		<th>Movie Year</th>
		</tr>
EOD;


// Retrieve Director Information
function get_director() 
{
	global $movie_director;
	global $director;
	
	$query_d = 	"SELECT people_fullname " .
				"FROM people " .
				"WHERE people_id='$movie_director'";

	$results_d = mysql_query($query_d)
		or die(mysql_error());
	
	$row_d = mysql_fetch_array($results_d);
	extract($row_d);
	
	$director = $people_fullname;
}

function get_leadactor() 
{
	global $movie_leadactor;
	global $leadactor;
	
	$query_a = 	"SELECT people_fullname " .
				"FROM people " .
				"WHERE people_id='$movie_leadactor'";
	
	$results_a = mysql_query($query_a)
		or die(mysql_error());

	$row_a = mysql_fetch_array($results_a);
	extract($row_a);
	
	$leadactor = $people_fullname;
	
}


$movie_details = '';
while ($row = mysql_fetch_array($result)) 
{
	$movie_name = $row['movie_name'];
	$movie_id = $row['movie_id'];
	$movie_director = $row['movie_director'];
	$movie_leadactor = $row['movie_leadactor'];
	$movie_year = $row['movie_year'];

	//get director’s name from people table
	get_director();

	//get lead actor’s name from people table
	get_leadactor();

	$movie_details .=<<<EOD
	<tr>
	<td><a href="movie_details.php?movie_id=$movie_id"
		title="Find out more about $movie_name">$movie_name</td>
	<td>$director</td>
	<td>$leadactor</td>
	<td>$movie_year</td>
	</tr>
EOD;
}

$movie_details .=<<<EOD
<tr align='center'>
<td colspan='4'>&nbsp;</td>
</tr>
<tr align='center'>
<td colspan='4'>Total: $num_movies Movies</td>
</tr>
EOD;

$movie_footer = "</table></body></html>";

$movie =<<<MOVIE
	$movie_header
	$movie_details
	$movie_footer
MOVIE;

echo "There are $num_movies movies in our database";
echo $movie;
mysql_free_result($result);
?>