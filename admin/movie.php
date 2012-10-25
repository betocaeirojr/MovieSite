<?php
	
	date_default_timezone_set('America/Sao_Paulo');

	$link = mysql_connect("localhost", "root", "root")
		or die("Could not connect: " . mysql_error());

		mysql_select_db('moviesite', $link)
			or die ( mysql_error());

	$peoplesql = "SELECT * FROM people";

	$result = mysql_query($peoplesql)
		or die("Invalid query: " . mysql_error());

	while ($row = mysql_fetch_array($result)) {
		$people[$row['people_id']] = $row['people_fullname'];
	}
	switch ($_GET['action']) {
		case "edit":
		
			$moviesql = 	"SELECT * FROM movie
							WHERE movie_id = '" . $_GET['id'] . "'";
			
			$result = mysql_query($moviesql)
				or die("Invalid query: " . mysql_error());
			
			$row = mysql_fetch_array($result);
			$movie_name = $row['movie_name'];
			$movie_type = $row['movie_type'];
			$movie_year = $row['movie_year'];
			$movie_leadactor = $row['movie_leadactor'];
			$movie_director = $row['movie_director'];
			$movie_release = $row['movie_release'];
			$movie_rating = $row['movie_rating'];
			break;
		
		default:
			$movie_name = "";
			$movie_type = "";
			$movie_year = "";
			$movie_leadactor = "";
			$movie_director = "";
			$movie_release = time();
			$movie_rating = "5";

			break;
	}
?>

<html>
	<head>
		<title><?php echo $_GET['action']; ?> movie</title>
		<style type="text/css">
			TD{color:#353535;font-family:verdana}
			TH{color:#FFFFFF;font-family:verdana;background-color:#336699}
		</style>
	</head>
	<body>
		<h1> Welcome to Movie Review Database Admin Site </h1>
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=movie&id=<?php echo $_GET['id']; ?>" method="post">
		
			<!-- Inserting Validation Code From Chapter 8 -->
			<?php
				if (!empty($_GET['error'])) { 
					echo "<div align=\"center\" " . 
					"style=\"color:#FFFFFF;background-color:#FF0000;" .
					"font-weight:bold\">" . nl2br(urldecode($_GET['error'])) .
					"</div><br>";
				}
			?>

			<!-- ================Iniciando TABLE ========================== -->
			<table border="0" width="750" cellspacing="1" cellpadding="3" bgcolor="#353535" align="center">
				
				<!-- ================ MOVIE NAME ====================== -->
				<tr>
					<td bgcolor="#FFFFFF" width="30%">Movie Name</td>
					<td bgcolor="#FFFFFF" width="70%">
						<input type="text" name="movie_name" value="<?php echo $movie_name; ?>">
					</td>
				</tr>
				
				<!-- ================ MOVIE TYPE ====================== -->
				<tr>
					<td bgcolor="#FFFFFF">Movie Type</td>
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

				<!-- ================ MOVIE YEAR ====================== -->
				<tr>
					<td bgcolor="#FFFFFF">Movie Year</td>
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

				<!-- ================ MOVIE LEAD ACTOR ====================== -->
				<tr>
					<td bgcolor="#FFFFFF">Lead Actor</td>
					<td bgcolor="#FFFFFF">
					<select name="movie_leadactor">
						<option value="" selected>Select an actor...</option>
<?php
						foreach ($people as $people_id => $people_fullname) {
							if ($people_id == $movie_leadactor) {
								$selected = " selected";
							} else {
								$selected = "";
							}

?>
						<option value="<?php echo $people_id; ?>" 
							<?php echo $selected; ?>
							><?php echo $people_fullname; ?></option>
<?php
						}
?>
					</select>
					</td>
				</tr>

				<!-- ================ MOVIE DIRECTOR ====================== -->
				<tr>
					<td bgcolor="#FFFFFF">Director</td>
					<td bgcolor="#FFFFFF">
						<select name="movie_director">
							<option value="" selected>Select a director...</option>
<?php
							foreach ($people as $people_id => $people_fullname) {
								if ($people_id == $movie_director) {
									$selected = " selected";
								} else {
									$selected = "";
								}

?>
							<option value="<?php echo $people_id; ?>" 
								<?php echo $selected; ?>
								><?php echo $people_fullname; ?></option>
<?php
							}

?>
						</select>
					</td>
				</tr>

				<!-- ================ MOVIE RELEASED DATE ====================== -->
				<tr>
					<td bgcolor="#FFFFFF" width="30%">Movie Released Date (dd-mm-yyyy)</td>
					<td bgcolor="#FFFFFF" width="70%">
						<input type="input" name="movie_release" value="<?php echo date("d-m-Y",$movie_release); ?>">
					</td>
				</tr>
				
				<!-- ================ MOVIE RATING ====================== -->
				<tr>
					<td bgcolor="#FFFFFF">Movie Rating (0 to 10) </td>
					<td bgcolor="#FFFFFF">
						<input type="text" name="movie_rating" value="<?php echo $movie_rating; ?>">
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
<?php  mysql_free_result($result); ?>

</html>






