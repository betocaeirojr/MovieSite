<PRE>
<?php print_r($_POST);
$arrayMovieType = array_values($_POST);
print_r($arrayMovieType);
?>
</pre>
<HTML>
<BODY>
	<TABLE>
		<TR> 
			<TD>Key </TD> 
			<TD>Value</TD>
		</TR>
		<TR>
			<TD> Genre </TD>
			<TD>
				<SELECT name="movietype">
				<?php 
				$index=0;
					for ($index=0; $index<(sizeof($arrayMovieType)-1); $index++)
					{
						echo "<OPTION value=$index>" . $arrayMovieType[$index] . "</OPTION>";
					}
				?>
				</SELECT>
			</TD>
		<TR>
	</TABLE>
</BODY>
</HTML>