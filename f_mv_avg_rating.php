<?php
	$link = mysql_connect("localhost","root","")
		or die(mysql_error());
	
	mysql_select_db("moviesite")
		or die (mysql_error());



?>
