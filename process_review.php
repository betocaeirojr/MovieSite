<?php

// Processes the form to create/edit a movie review.
// Retrieve POST variables

$MovieId 			= $_POST['movie_id'];
$MovieReviewDate	= $_POST['review_date'];
$MovieReviewTitle	= $_POST['review_title'];
$MovieReviewAuthor	= $_POST['reviewer_name'];
$MovieReviewComment	= $_POST['review_comments'];
$MovieReviewRating	= $_POST['review_rating'];



// Check inputed data

// If all ok send to DB
include "admin/connect_to_db.php";

$insertSQL = "INSERT INTO reviews 
			 VALUES ($MovieId, 
			 		'$MovieReviewDate', 
			 		'$MovieReviewTitle', 
			 		'$MovieReviewAuthor', 
			 		'$MovieReviewComment', 
			 		$MovieReviewRating)";

//echo $insertSQL;

$insertResult = mysql_query($insertSQL)
	or die (mysql_error());

// Test if the insert is OK

// Send back to the Movie Page, with the info refreshed
header("location:movie_details.php?movie_id=$MovieId");

?>
