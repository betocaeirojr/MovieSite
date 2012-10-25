<?php
$strMovieTitle 		= $_POST['MovieTitle'];
$strMovieDirector	= $_POST['MovieDirector'];
$strMovieLeadActor	= $_POST['MovieLeadActor'];
$intMovieRuningTime	= $_POST['MovieRunningTime'];
$intMovieRating 	= $_POST['MovieRating'];
$strMovieReview		= $_POST['MovieReview']; 
?>


<pre>
<?php print_r($_POST);?>
</pre>
<HTML>
	<HEAD>
		<TITLE> See the info you have just inserted </TITLE>
	</HEAD>
	<BODY>
		<TABLE border=1>
		<TR bgcolor="lightgrey">
			<th>Year of Release</th>
			<th>Movie Director</th>
			<th>Movie Lead Actor</th>
			<th>Movie Running Time</th>
			<TH>Movie Rating</th>
			<TH>Movie Review</TH>
		</tr>
		<tr>
			<TD><?php echo $strMovieTitle; ?></TD>
			<TD><?php echo $strMovieDirector; ?></TD>
			<TD><?php echo $strMovieLeadActor; ?></TD>
			<TD><?php echo $intMovieRuningTime; ?></TD>
			<TD><?php echo $intMovieRating; ?></TD>
			<TD><?php echo $strMovieReview; ?></TD>
		</tr>
		</TABLE>
	</BODY>
</HTML>