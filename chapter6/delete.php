<?php
	$link = mysql_connect("localhost", "root", "root")
		or die("Could not connect: " . mysql_error());

	mysql_select_db('moviesite', $link)
		or die ( mysql_error());

// DELETE SCRIPT
	if (!isset($_GET['do']) || $_GET['do'] != 1) {
?>
		<p align="center" style="color:#FF0000"> Are you sure you want to delete this <?php echo $_GET['type']; ?>?<br>
			<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&do=1">yes</a> or <a href="index.php">Index</a>
		</p>
<?php

	} else {
		if ($_GET['type'] == "people") {
		
		// delete references to people from the movie table
		
		// delete reference to lead actor
		$actor = 	"UPDATE movie
					SET movie_leadactor = '0'
					WHERE movie_leadactor = '" . $_GET['id'] . "'";

		$result = mysql_query($actor)
			or die("Invalid query: " . mysql_error());
		
		// delete reference to director
		$director = 	"UPDATE movie
						SET movie_director = '0'
						WHERE movie_director = '" . $_GET['id'] . "'";
		
		$result = mysql_query($director)
			or die("Invalid query: " . mysql_error());
	}
	// generate SQL
	$sql = 	"DELETE FROM " . $_GET['type'] . 
			" WHERE " . $_GET['type'] . "_id = '" . $_GET['id'] . "'
			LIMIT 1";

	// echo SQL for debug purpose
	echo "<!--" . $sql . "-->";
	$result = mysql_query($sql)
	or die("Invalid query:  " . mysql_error());
?>
	<p align="center" style="color:#FF0000"> 
		Your <?php echo $_GET['type']; ?> has been deleted. <a href="index.php">Index</a>
	</p>
<?php
	}
?>