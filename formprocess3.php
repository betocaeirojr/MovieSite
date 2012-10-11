<?php
if ($_POST['type'] == "Movie" && $_POST['MovieType'] == ""){
header("Location:form3.php");}
$title = $_POST['Submit'] . " "  .
$_POST['type'] . " :  " .
$_POST['Name'];
echo "<html>\n<head>\n<title>\n" . $title . "\n</title>\n</head>\n";
echo "<body>\n";
if ($_POST['Debug'] == "on")
{
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
}
$name = $_POST['Name'];
$name[0] = strtoupper($name[0]);
if ($_POST['type'] == "Movie") 
{
	$foo = $_POST['MovieType'] . " " . $_POST['type'];
} else 
{
	$foo = $_POST['type'];
}

echo "<p align=\"center\">";
echo "You are " . $_POST['Submit'] . "ing ";
echo $_POST[‘Submit’] == "Search" ? "for " : ""; 
echo "a $foo ";
echo "named $name";
echo "</p>\n</body>";
?>

