<HTML>
	<HEAD>
		<TITLE> Edit a comment and a rating </TITLE>
	</HEAD>
	<BODY>
		<H1> Please provide a comment and a rating </H1>
		<FORM action="form_process_movie.php" method="post">
			<TABLE border=1>
				<TR>
					<TH> Key </TH>
					<TH> Value</TH>
				</TR>
				<TR>
					<TD> Movie: </TD>
					<TD><SELECT name="MovieTitle">
							<option value="" selected>Movie Name...</option>
							<OPTION value="BruceAlmighty">Bruce Almighty</OPTION>
							<OPTION value="GrandCanyon">Grand Canyon</OPTION>
							<OPTION value="OfficeSpace">Office Space</OPTION>
						</SELECT>
					</TD>
				</TR>
				<TR>
					<TD> Released at: </TD>
					<TD><SELECT name="MovieYear">
							<?php 
								for ($year=1970; $year<=date('Y'); $year++) {
									echo "<OPTION value=\"$year\">" . $year . "</OPTION>";
								}
							?>
						</SELECT>
					</TD>
				</TR>
				<TR>
					<TD> Directed By </TD>
					<TD><INPUT type="text" name="MovieDirector"></INPUT>
					</TD>
				</TR>
				<TR>
					<TD> Lead Actor </TD>
					<TD><INPUT type="text" name="MovieLeadActor"></INPUT>
					</TD>
				</TR>
				<TR>
					<TD> Movie Runing Time (hs) </TD>
					<TD><INPUT type="text" name="MovieRunningTime"></INPUT>
					</TD>
				</TR>
				<TR>
					<TD> Movie Rating: </TD>
					<TD> <SELECT name="MovieRating">
							<option value="" selected>Select a Rating...</option>
							<OPTION value="1">1</OPTION>
							<OPTION value="2">2</OPTION>
							<OPTION value="3">3</OPTION>
							<OPTION value="4">4</OPTION>
							<OPTION value="5">5</OPTION>
						 </SELECT>
					</TD>
				</TR>
				<TR>
					<TD> Movie Review </TD>
					<TD><TEXTAREA cols="40" rows="4" name="MovieReview">Please insert your review here</textarea></TD>
				</TR>
				<TR>
					<TD colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></TD>
				</TR>
			</TABLE>
		</FORM>
	</BODY>
</HTML>


<tr bgcolor="lightgrey">
<th>Year of Release</th>
<th>Movie Director</th>
<th>Movie Lead Actor</th>
<th>Movie Running Time</th>
<th>Movie Health</th>
<th>Average Rating<BR>0 (Very Bad) -- 5 (Excellent)</th>
</tr>

