<PRE>
<?php  print_r($_POST); ?>
</PRE>

<?php
// COMMIT ADD AND EDITS
	$link = mysql_connect("localhost", "root", "root")
	or die("Could not connect: " . mysql_error());
	
	mysql_select_db('moviesite', $link)
		or die ( mysql_error());

	switch ($_GET['action']) {
		case "edit":
			switch ($_GET['type']) {
				case "movie":
					$sql = "UPDATE movie SET
					movie_name = '" . $_POST['movie_name'] . "',
					movie_year = '" . $_POST['movie_year'] . "',
					movie_type = '" . $_POST['movie_type'] . "',
					movie_leadactor = '" .$_POST['movie_leadactor']."',
					movie_director = '" . $_POST['movie_director'] . "'
					WHERE movie_id = '" . $_GET['id'] . "'";
					break;
				
				case "person":
					$sql = "UPDATE person SET
					people_fullname = '" . $_POST['Fullname'] . " ',
					people_isactor =  '" . $_POST['isLeadactor'] . "', 
					people_isdirector = '" . $_POST['isDirector'] . "' 
					WHERE people_id = '" . $_GET['id'] . "'";
					break;
			}
			break;
		case "add":
			switch ($_GET['type']) {
				case "movie":

					$sql 	= 	"INSERT INTO movie
								(movie_name,
								movie_year,
								movie_type,
								movie_leadactor,
								movie_director)
								VALUES
								(
									'" . $_POST['movie_name'] . "',
									'". $_POST['movie_year'] . "',
									'" . $_POST['movie_type'] . "',
									'" . $_POST['movie_leadactor'] . "',
									'" . $_POST['movie_director'] . "'
								)";
					
					break;
				case "person" :

					$sql = 		"INSERT INTO people 
								(people_fullname, people_isactor, people_isdirector) 
								VALUES
								( 	'" . $_POST['Fullname'] 	. "' ,
									'" . $_POST['isLeadactor'] 	. "' ,
									'" . $_POST['isDirector'] 	. "'
								)";
					break;

			}
			break;
	}

	if (isset($sql) && !empty($sql)) {
		echo "<!-- SQL: " . $sql . "-->";
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
?>
		<p align="center" style="color:#FF0000"> Done. <a href="index.php">Index</a></p>
<?php
	}
?>