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

	// Define what to do based on the Action attribuite sent by querystring
	switch ($_GET['action']) {
		case "edit":
		
			$peoplesql = 	"SELECT * FROM people
							WHERE people_id = '" . $_GET['id'] . "'";
			
			$result = mysql_query($peoplesql)
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=person&id=<?php echo $_GET['id']; ?>" method="post">
			<table border="0" width="750" cellspacing="1" cellpadding="3" bgcolor="#353535" align="center">
				<tr>
					<td bgcolor="#FFFFFF" width="30%">Person Fullname</td>
					<td bgcolor="#FFFFFF" width="70%">
						<input type="text" name="Fullname" value="<?php echo $people_fullname; ?>">
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF">Is Leading Actor?</td>
					<td bgcolor="#FFFFFF">
						<select name="isLeadactor">
							<?php 
								if ($people_isactor == "1"){
									// If isLead Actor, YES=>1 == selected
									echo "<option value=\"0\"> No </option>";
									echo "<option value=\"1\" selected> Yes </option>";
									
								}else {
									// If isLead Actor, NO=>0 == selected
									echo "<option value=\"0\" selected> No </option>";
									echo "<option value=\"1\" > Yes </option>";
								}
							?>
						</select>

					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF">Is Director</td>
					<td bgcolor="#FFFFFF">
						<select name="isDirector">
							<?php 
								if ($people_isdirector == "1"){
									// If isDirector, YES=>1 == selected
									echo "<option value=\"0\"> No </option>";
									echo "<option value=\"1\" selected> Yes </option>";
									
								}else {
									// If isDirector, NO=>0 == selected
									echo "<option value=\"0\" selected> No </option>";
									echo "<option value=\"1\" > Yes </option>";
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
<?php mysql_free_result($result); ?>
</html>






