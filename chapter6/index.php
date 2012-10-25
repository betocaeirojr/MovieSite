<?php
	$link = mysql_connect("localhost", "root", "root")
		or die("Could not connect: " . mysql_error());
	
	mysql_select_db('moviesite', $link)
		or die(mysql_error());
?>

<html>
	<head>
		<title>Movie database</title>
		<style type=”text/css”>
			TD{color:#353535;font-family:verdana}
			TH{color:#FFFFFF;font-family:verdana;background-color:#336699}
		</style>
	</head>
	<body>
		<center><h1> Welcome to Movie Review Database Admin Site </h1></center>
		<table border="0" width="600" cellspacing="1" cellpadding="3" bgcolor="#353535" align="center">
			<tr>
				<td bgcolor="#FFFFFF" colspan="2" align="center"> Movies <a href="movie.php?action=add&id=">[ADD]</a></td>
			</tr>
	<?php
		$moviesql = "SELECT * FROM movie";
		$result = mysql_query($moviesql)
			or die("Invalid query: " . mysql_error());
		while ($row = mysql_fetch_array($result)) {
	?>
			<tr>
				<td bgcolor="#FFFFFF" width="50%"><?php echo $row['movie_name']; ?> </td>
				<td bgcolor="#FFFFFF" width="50%" align="right">
					<a href="movie.php?action=edit&id=<?php echo $row['movie_id']; ?>">[EDIT]</a>
					<a href="delete.php?type=movie&id=<?php echo $row['movie_id']; ?>">[DELETE]</a>
				</td>
			</tr>
	<?php
		}
	?>
			<tr>
				<td bgcolor="#FFFFFF" colspan="2" align="center"> People <a href="people.php?action=add&id=">[ADD]</a></td>
			</tr>

	<?php
		$moviesql = "SELECT * FROM people";
		$result = mysql_query($moviesql)
			or die("Invalid query: " . mysql_error());

		while ($row = mysql_fetch_array($result)) {
	?>
			<tr>
				<td bgcolor="#FFFFFF" width="50%"><?php echo $row['people_fullname']; ?></td>
				<td bgcolor="#FFFFFF" width="50%" align="right">
					<a href="people.php?action=edit&id=<?php echo $row['people_id']; ?>">[EDIT]</a>
					<a href="delete.php?type=people&id=<?php echo $row['people_id']; ?>">[DELETE]</a>
				</td>
			</tr>
	<?php
		}
		mysql_free_result($result);
	?>
		</table>
	</body>
</html>
