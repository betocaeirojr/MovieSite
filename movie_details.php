<?php
	$link = mysql_connect("localhost","root","root")
		or die(mysql_error());
	
	mysql_select_db("moviesite")
		or die (mysql_error());

/////////////////////////////////////////////////////////////////////////
//
// Starting Function Definitions
//
//////////////////////////////////////////////////////////////////////////


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

function generate_ratings($review_rating) 
{
	$movie_rating = '';
	for( $i=0; $i<$review_rating; $i++ ) 
	{
		$movie_rating .= "+ &nbsp;";
	}
	return $movie_rating;
}

/////////////////////////////////////////////////////////////////////////
//
// Ending Function Definitions
//
//////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////
// Creating the HTML Section for Movie General Details
/////////////////////////////////////////////////////////////////////////


$movie_table_headings=<<<EOD
<tr bgcolor="lightgrey">
<th>Movie Title</th>
<th>Year of Release</th>
<th>Movie Director</th>
<th>Movie Lead Actor</th>
<th>Movie Running Time</th>
<th>Movie Health</th>
<th>Average Rating<BR>0 (Very Bad) -- 5 (Excellent)</th>
</tr>
EOD;

// Query Movie Details

$movie_query = "SELECT * FROM movie " 				.
		 "WHERE movie_id ='" . $_GET['movie_id'] . "'";

$movie_result = mysql_query($movie_query, $link)
	or die(mysql_error());

while ($row = mysql_fetch_array($movie_result)) 
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

// Calculating Movie General Rating

// Preparing SQL Statement
$avgRating_query = "SELECT sum(review_rating) / count(*) as AvgRating FROM reviews " 				.
		 "WHERE review_movie_id ='" . $_GET['movie_id'] . "'";

$avgRating_result = mysql_query($avgRating_query, $link)
	or die(mysql_error());

$row_count = mysql_fetch_assoc($avgRating_result);
$movie_average_rate = $row_count['AvgRating'];

$movie_details =<<<EOD
<table width="70%" border="1" cellspacing="2" cellpadding="2" align="center">
<tr>
	<th bgcolor="grey" colspan="7"><u><h2>$movie_name: Details</h2></u></th>
</tr>
$movie_table_headings
<tr>
	<td width="33%" align="center">$movie_name</td>
	<td align="center">$movie_year</td>
	<td align="center">$director</td>
	<td align="center">$leadactor</td>
	<td align="center">$movie_running_time</td>
	<td align="center">$movie_health</td>
	<td align="center">$movie_average_rate</td>
</tr>
</table>
<br>
<br>
EOD;



/////////////////////////////////////////////////////////////////////////
// Creating the HTML Section for Movie Reviews
/////////////////////////////////////////////////////////////////////////
$idMovie=$_GET['movie_id'];

$review_table_headings=<<<EOD
<tr bgcolor="lightgrey">
<th><a href="movie_details.php?sort_by=review_date&movie_id=$idMovie">Date of Review</a></th>
<th><a href="movie_details.php?sort_by=review_name&movie_id=$idMovie">Review Title</a></th>
<th><a href="movie_details.php?sort_by=review_reviewer_name&movie_id=$idMovie">Reviewer Name</a></th>
<th><a href="movie_details.php?sort_by=review_comment&movie_id=$idMovie">Movie Review Comments</a></th>
<th><a href="movie_details.php?sort_by=review_rating&movie_id=$idMovie">Rating</a></th>
</tr>
EOD;

// Starting the ordering selection criteria for Movie Review
if (isset($_GET['sort_by']))
{
	if (($_GET['sort_by'] == "review_date") OR ($_GET['sort_by'] == "review_rating"))
		$order_by_clause =  " ORDER BY " .$_GET['sort_by']. " DESC";
	else 
		$order_by_clause =  " ORDER BY " .$_GET['sort_by']. " ASC";
}else
{
	$order_by_clause = "";
}

$review_query = "SELECT * FROM reviews " .
				"WHERE review_movie_id ='" . $_GET['movie_id'] . "'" . $order_by_clause;


//$review_query = "SELECT * FROM reviews " .
//				"WHERE review_movie_id ='" . $_GET['movie_id'] . "' " .
//				"ORDER BY review_rating ASC";

$review_result = mysql_query($review_query, $link)
	or die(mysql_error());



while($review_row = mysql_fetch_array($review_result)) 
{
	$review_flag = 1;
	$review_title[] = $review_row['review_name'];
	$reviewer_name[] = ucwords($review_row['review_reviewer_name']);
	$review[] = $review_row['review_comment'];
	$review_date[] = $review_row['review_date'];
	$review_rating[] = generate_ratings($review_row['review_rating']);
}


$i = 0;
$review_details = '';
while ($i<sizeof($review)) 
{
	 if (($i % 2) == 0)
	 {
	 	// Odd Number
	 	$ColorBackground = '#D4ED91';

	 } else
	 {
	 	// Even Number
	 	$ColorBackground = '#D1EEEE';
	 }

$review_details .=<<<EOD
<tr bgcolor="$ColorBackground">
<td width="15%" valign="top" align="center">$review_date[$i]</td>
<td width="15%" valign="top">$review_title[$i]</td>
<td width="10%" valign="top">$reviewer_name[$i]</td>
<td width="50%" valign="top">$review[$i]</td>
<td width="10%" valign="top" align=”center”>$review_rating[$i]</td>
</tr>
EOD;
$i++;
}


/////////////////////////////////////////////////////////////////////////
// Assembling Page Pieces
/////////////////////////////////////////////////////////////////////////



$page_start =<<<EOD
<html>
<head>
<title>Details and Reviews for: $movie_name</title>
</head>
<body>
EOD;



if ($review_flag) 
{
$movie_details .=<<<EOD
<table width="95%" border="1" cellspacing="2" cellpadding="20" align="center">
$review_table_headings
$review_details
</table>
EOD;
}

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