<?php
	$link = mysql_connect("localhost","root","")
		or die(mysql_error());
	
	mysql_select_db("moviesite")
		or die (mysql_error());
	
	//alter “movie” table to include running time/cost/takings fields
	$add = 	"ALTER TABLE movie ADD COLUMN ( " 	.
			"movie_running_time int NULL, " 	.
			"movie_cost int NULL, " 			.
			"movie_takings int NULL)";
	
	$results = mysql_query($add)
		or die(mysql_error());
	
	echo $results;

	//insert new data into “movie” table for each movie
	$update = 	"UPDATE movie SET " 		.
				"movie_running_time=102, " 	.
				"movie_cost=10, " 			.
				"movie_takings=15 " 		.
				"WHERE movie_id = 1";
	
	$results = mysql_query($update)
		or die(mysql_error());
	
	echo $results;

	$update = 	"UPDATE movie SET " 		.
				"movie_running_time=90, " 	.
				"movie_cost=3, " 			.
				"movie_takings=90 " 		.
				"WHERE movie_id = 2";
	
	$results = mysql_query($update)
		or die(mysql_error());

	echo $results;	
	
	$update = 	"UPDATE movie SET " 		.
				"movie_running_time=134, " 	.
				"movie_cost=15, " 			.
				"movie_takings=10 " 		.
				"WHERE movie_id = 3";
	
	$results = mysql_query($update)
		or die(mysql_error());

	echo $results;	

	
?>