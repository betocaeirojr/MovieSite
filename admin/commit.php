<PRE>
<?php  print_r($_POST); ?>
</PRE>

<?php
// COMMIT ADD AND EDITS
	$error = '';

	$link = mysql_connect("localhost", "root", "root")
	or die("Could not connect: " . mysql_error());
	
	mysql_select_db('moviesite', $link)
		or die ( mysql_error());

	switch ($_GET['action']) {
		
		// CASE EDIT
		case "edit":
			switch ($_GET['type']) {
				case "movie":
					$movie_rating = trim($_POST['movie_rating']);
					if (!is_numeric($movie_rating)) {
						$error .= "Please+enter+a+numeric+rating+%21%0D%0A";
					} else {
						if ($movie_rating < 0 || $movie_rating > 10) {
							$error .= "Please+enter+a+rating+" . "between+0+and+10%21%0D%0A";
						}
					}
					if (!ereg("([0-9]{2})-([0-9]{2})-([0-9]{4})", $_POST['movie_release'] , $reldatepart)) {
						$error .= "Please+enter+a+date+" . "with+the+dd-mm-yyyy+format%21%0D%0A";
					} else {
						$movie_release = @mktime(0, 0, 0, $reldatepart['2'], $reldatepart['1'], $reldatepart['3']);
					
						if ($movie_release == '-1') {
							$error .= "Please+enter+a+real+date+" . "with+the+dd-mm-yyyy+format%21%0D%0A";
						}
					}

					$movie_name = trim($_POST['movie_name']);
					if (empty($movie_name)) {
						$error .= "Please+enter+a+movie+name%21%0D%0A";
					}
					if (empty($_POST['movie_type'])) {
						$error .= "Please+select+a+movie+type%21%0D%0A";
					}
					if (empty($_POST['movie_year'])) {
						$error .= "Please+select+a+movie+year%21%0D%0A";
					}

					if (empty($error)) {
						$sql = "UPDATE movie SET
						movie_name = '" . $_POST['movie_name'] . "',
						movie_year = '" . $_POST['movie_year'] . "',
						movie_type = '" . $_POST['movie_type'] . "',
						movie_leadactor = '" .$_POST['movie_leadactor']."',
						movie_director = '" . $_POST['movie_director'] . "',
						movie_release = '" . $movie_release . "',
						movie_rating = '" . $movie_rating . "'
						WHERE movie_id = '" . $_GET['id'] . "'";
					} else {
						header("location:movie.php?action=edit&error=" . 
							$error . "&id=" . $_GET['id'] );
					}


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

		// CASE ADD	
		case "add":
			switch ($_GET['type']) {
				case "movie":
					$movie_rating = trim($_POST['movie_rating']);
					if (!is_numeric($movie_rating)) {
						$error .= "Please+enter+a+numeric+rating+%21%0D%0A";
					} else {
						if ($movie_rating < 0 || $movie_rating > 10) {
							$error .= "Please+enter+a+rating+" . "between+0+and+10%21%0D%0A";
						}
					}

					$movie_release = trim($_POST['movie_release']);
					if (!ereg("([0-9]{2})-([0-9]{2})-([0-9]{4})", $movie_release, $reldatepart) || empty($movie_release)) {
						$error .= "Please+enter+a+date+" .
						"with+the+dd-mm-yyyy+format%21%0D%0A";
					} else {
						$movie_release = @mktime(0, 0, 0, $reldatepart['2'], $reldatepart['1'], $reldatepart['3']);
						if ($movie_release == '-1') {
							$error .= "Please+enter+a+real+date+" .
							"with+the+dd-mm-yyyy+format%21%0D%0A";
						}
					}


					$movie_name = trim($_POST['movie_name']);
					if (empty($movie_name)) {
						$error .= "Please+enter+a+movie+name%21%0D%0A";
					}
					if (empty($_POST['movie_type'])) {
						$error .= "Please+select+a+movie+type%21%0D%0A";
					}
					if (empty($_POST['movie_year'])) {
						$error .= "Please+select+a+movie+year%21%0D%0A";
					}
					if (empty($error)) {

						$sql 	= 	"INSERT INTO movie
									(movie_name,
									movie_year,
									movie_type,
									movie_leadactor,
									movie_director,
									movie_release,
									movie_rating)
									VALUES
									(
										'" . $_POST['movie_name'] . "',
										'". $_POST['movie_year'] . "',
										'" . $_POST['movie_type'] . "',
										'" . $_POST['movie_leadactor'] . "',
										'" . $_POST['movie_director'] . "',
										'" . $movie_release. "',
										'" . $movie_rating . "'
									)";
					} else {
						echo "<PRE>" . print_r($reldatepart) . "</PRE>";
						//header("location:movie.php?action=add&error=" . $error);
					} 
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
		<p align="left" style="color:#FF0000"><?php echo $sql; ?></p>
		<pre><?php print_r($reldatepart);?></pre>
		<p align="center" style="color:#FF0000"> Done. <a href="index.php">Index</a></p>
<?php
	}
?>