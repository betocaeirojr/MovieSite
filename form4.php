<?php
// Debug info Display
function debugDisplay() {
?>
<pre>
$_POST
<?php
print_r($_POST);
?>
$_GET
<?php
print_r($_GET);
?>
</pre>
<?php
}
if (!isset($_GET['step'])) {
require('startform.php');
} else {
// Switch on search/add wizard step
switch ($_GET['step']) {
// #################
// Search/Add form
// #################
case "1":
$type = explode(":", $_POST['type']);
if ($_POST['Submit'] == "Add") {
require($_POST['Submit'] . $type[0] . '.php');
} else {
if ($_POST['type'] == "Movie:Movie" &&
$_POST['MovieType'] == ""){
header("Location:form4.php");
}
?>
<h1>Search Results</h1>
<p>You are looking for a "<?php echo $type[1]; ?>" named
"<?php echo $_POST['Name']; ?>"</p>
<?php
}
if ($_POST['Debug'] == "on") {
debugDisplay();
}
break;
// #################
// Add Summary
// #################
case "2":
$type = explode(":", $_POST['type']);
?>
<h1>New <?php echo $type[1]; ?> : <?php echo $_POST['Name']; ?></h1>
<?php
switch ($type[0]) {
case "Movie":
?>
<p>Released in <?php echo $_POST['MovieYear']; ?></p>
<p><?php echo nl2br(stripslashes($_POST['Desc'])); ?></p>
<?php
break;
default:
?>
<h2>Quick Bio</h2>
<p><?php echo nl2br(stripslashes($_POST['Bio'])); ?></p>
<?php
break;
}
break;
// ###############
// Starting form
// ###############
default:
require('startform.php');
break;
}
}
?>
