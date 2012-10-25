<?php
	// Establish a db connection
	$link = mysql_connect("localhost", "root", "root")
		or die("Could not connect: " . mysql_error());

		// Define the db to be used
		mysql_select_db('moviesite', $link)
			or die ( mysql_error());

	// prepare the SQL statement
	$peoplesql = "SELECT * FROM people";

	// Query the SQL
	$result = mysql_query($peoplesql)
		or die("Invalid query: " . mysql_error());

	// Populate People Array
	while ($row = mysql_fetch_array($result)) {
		$people[$row['people_id']] = $row['people_fullname'];
	}
	switch ($_GET['action']) {
		case "edit":
		
			$peoplesql = 	"SELECT * FROM people
							WHERE people_id = '" . $_GET['id'] . "'";
			
			$result = mysql_query($moviesql)
				or die("Invalid query: " . mysql_error());
			
			$row = mysql_fetch_array($result);
			$people_fullname = $row['people_fullname'];
			$people_isactor = $row['people_isactor'];
			$people_isdirector = $row['people_isdirector'];
			break;
		
		default:
			$people_fullname = "";
			$people_isactor = "";
			$people_isdirector = "";
			break;
	}
?>

<html>
	<head>
		<title><?php echo $_GET['action']; ?> People </title>
		<style type="text/css">
			TD{color:#353535;font-family:verdana}
			TH{color:#FFFFFF;font-family:verdana;background-color:#336699}
		</style>
	</head>
	<body>
		<h1> Welcome to Movie Review Database Admin Site </h1>
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=movie&id=<?php echo $_GET['id']; ?>" method="post">
			<table border="0" width="750" cellspacing="1" cellpadding="3" bgcolor="#353535" align="center">
				<tr>
					<td bgcolor="#FFFFFF" width="30%">People Fullname</td>
					<td bgcolor="#FFFFFF" width="70%">
						<input type="text" name="movie_name" value="<?php echo $movie_name; ?>">
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF">Is Leading Actor?</td>
					<td bgcolor="#FFFFFF">
						<select id="game" name="movie_type" style="width:150px">
<?php
							$sql = 	"SELECT movietype_id, movietype_label " .
									"FROM movietype ORDER BY movietype_label";

							$result = mysql_query($sql)
								or die("<font color=\"#FF0000\">Query Error</font>" . mysql_error());
							
							while ($row = mysql_fetch_array($result)) {
								if ($row['movietype_id'] == $movie_type) {
									$selected = " selected"	;
								} else {
									$selected = "";
								}
								echo '<option value="' . $row['movietype_id'] . '"' .
								$selected . '>' . $row['movietype_label'] . '</option>' . "\r\n";
							}
?>
						</select>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF">Is Director</td>
					<td bgcolor="#FFFFFF">
						<select name="movie_year">
							<option value="" selected>Select a year...</option>

<?php
							for ($year = date("Y"); $year >= 1970; $year--) {
								if ($year==$movie_year) {
									$selected = " selected";
								} else {
									$selected = "";
								}
?>
							<option value="<?php echo $year; ?>" 
								<?php echo $selected; ?>
								><?php echo $year; ?></option>
<?php
							}
?>

						</select>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" colspan="2" align="center">
						<input type="submit" name="SUBMIT" value="<?php echo $_GET['action']; ?>">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>






