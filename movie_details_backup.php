<?php
	$link = mysql_connect("localhost","root","")
		or die(mysql_error());
	
	mysql_select_db("moviesite")
		or die (mysql_error());

/* Function to calculate if a movie made a profit,
loss or broke even */
function calculate_differences($takings, $cost) 
{
	$difference = $takings - $cost;
	if ($difference < 0) 
	{
		$difference = substr($difference, 1);
		$font_color = "red";
		$profit_or_loss = "$" . $difference . "m";
	} elseif ($difference > 0) 
	{
		$font_color ="green";
		$profit_or_loss = "$" . $difference . "m";
	} else 
	{
		$font_color = "blue";
		$profit_or_loss = "Broke even";
	}
	return "<font color=\"$font_color\">" . $profit_or_loss . "</font>";
}

/* Function to get the director’s name from the people table */
function get_director() 
{
	global $movie_director;
	global $director;
	
	$query_d = 	"SELECT people_fullname " 	.
				"FROM people "		 		.
				"WHERE people_id='$movie_director'";

	$results_d = mysql_query($query_d)
		or die(mysql_error());
	
	$row_d = mysql_fetch_array($results_d);
	extract($row_d);
	
	$director = $people_fullname;
}

/* Function to get the lead actor’s name from the people table */
function get_leadactor() 
{
	global $movie_leadactor;
	global $leadactor;
	
	$query_a = 	"SELECT people_fullname "			.
				"FROM people " 						.
				"WHERE people_id='$movie_leadactor'";

	$results_a = mysql_query($query_a)
		or die(mysql_error());
	$row_a = mysql_fetch_array($results_a);
	extract($row_a);
	
	$leadactor = $people_fullname;
}

// Query Movie Details

$query = "SELECT * FROM movie " 				.
		 "WHERE movie_id ='" . $_GET['movie_id'] . "'";

$result = mysql_query($query, $link)
	or die(mysql_error());


$movie_table_headings=<<<EOD
<tr>
<th>Movie Title</th>
<th>Year of Release</th>
<th>Movie Director</th>
<th>Movie Lead Actor</th>
<th>Movie Running Time</th>
<th>Movie Health</th>
</tr>
EOD;

while ($row = mysql_fetch_array($result)) 
{
	$movie_name = $row['movie_name'];
	$movie_director = $row['movie_director'];
	$movie_leadactor = $row['movie_leadactor'];
	$movie_year = $row['movie_year'];
	$movie_running_time = $row['movie_running_time'] . " mins";
	$movie_takings = $row['movie_takings'];
	$movie_cost = $row['movie_cost'];

	//get director’s name from people table
	get_director();
	//get lead actor’s name from people table
	get_leadactor();
}

$movie_health = calculate_differences($movie_takings, $movie_cost);

$page_start =<<<EOD
<html>
<head>
<title>Details and Reviews for: $movie_name</title>
</head>
<body>
EOD;

$movie_details =<<<EOD
<table width="70%" border="1" cellspacing="2" cellpadding="2" align="center">
<tr>
	<th colspan="6"><u><h2>$movie_name: Details</h2></u></th>
</tr>
$movie_table_headings
<tr>
	<td width="33%" align="center">$movie_name</td>
	<td align="center">$movie_year</td>
	<td align="center">$director</td>
	<td align="center">$leadactor</td>
	<td align="center">$movie_running_time</td>
	<td align="center">$movie_health</td>
</tr>
</table>
<br>
<br>
EOD;

$page_end =<<<EOD
</body>
</html>
EOD;

$detailed_movie_info =<<<EOD
$page_start
$movie_details
$page_end
EOD;

echo $detailed_movie_info;

mysql_close();
?>