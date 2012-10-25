<?php
if (isset($_GET['check_results'])==true)
{
	if (($_POST['Number1']!=0) && ($_POST['Number1']!=0) )
	{
		$intNumber1 = $_POST['Number1'];
		$intNumber2 = $_POST['Number2'];
		$typeOperation = $_POST['Operation'];
		
		switch($typeOperation)
		{
			case "Sum":
				$Result = $intNumber1 + $intNumber2;
				$Operator = '+';
				break;
			case "Sub":
				$Result = $intNumber1 - $intNumber2;
				$Operator = '-';
				break;
			case "Plus":
				$Result = $intNumber1 * $intNumber2;
				$Operator = '*';
				break;
			case "Div":
				$Result = $intNumber1 / $intNumber2;
				$Operator = '/';
				break;
		}
	}
}
?>

<PRE>
<?php 
print_r($_GET);
print_r($_POST);
?>
</PRE>
<HTML>
	<HEAD>
		<TITLE> My Calculator </TITLE>
	</HEAD>
	<BODY>
		<H1> Beto's Calculator and Converter</H1>
		<FORM action="form_sum.php?check_results=1" method="post">
			<TABLE border=1>
				<TR>
					<TH> Number 1 </TH>
					<TH> Number 2 </TH>
					<TH> Operation ( 'Number 1' Operation 'Number 2')</TH>
				</TR>
				<TR>
					<TD><INPUT type="text" name="Number1"></TD>
					<TD><INPUT type="text" name="Number2"></TD>
					<TD>
						<INPUT type="radio" name="Operation" value="Sum" checked>Sum  / 
						<INPUT type="radio" name="Operation" value="Sub">Subtract <BR>	
						<INPUT type="radio" name="Operation" value="Plus">Multiple  /  
						<INPUT type="radio" name="Operation" value="Div">Divide <BR>	
					</TD>
				</TR>
				<TR>
					<TD colspan=3 align="center"><input type="submit" value="submit" name="submit"></TD>
				</TR>
			</TABLE>
		</FORM>

		<P> Please Check the results bellow</P>
		<?php  
			if (isset($_GET['check_results'])==true)
			{
				echo $intNumber1 . " " . $Operator ." " . $intNumber2 . ' = '	. $Result; 
			}
		?>
	</BODY>
</HTML>