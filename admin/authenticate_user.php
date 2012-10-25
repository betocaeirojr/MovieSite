<?
session_start();
$User_name = $_POST['username'];
$User_pass = $_POST['userpass'];

$arrayUserInfo_Name = array(	"Value" => $User_name,
								"Name" => "Username",
								"Type" => "Text",
								"MaxLength" => 255,
								"MinLength" => 6
							);
$arrayUserInfo_Pass = array(	"Value" => $User_pass,
								"Name" => "User Password",
								"Type" => "Text",
								"MaxLength" => 16,
								"MinLength" => 6
							);

echo "<PRE>";
echo "User_Info_Name: "; 
print_r($arrayUserInfo_Name);

echo "User_Info_Pass: ";
print_r($arrayUserInfo_Pass);
echo "<BR>" . $User_name . " / " . $User_pass . "<BR>";
echo "</PRE>"; 

//validate user entry
include "validate_input_by_user.php";

$isValidInfoName = arrayValidateUserData($arrayUserInfo_Name);
echo "Returning after validating the first field...<BR>";

$isValidInfoPass = arrayValidateUserData($arrayUserInfo_Pass);
echo "Returning after validating the second field...<BR>";

if (($isValidInfoName == 0) && ($isValidInfoPass==0)) {
	// echo "Values Name and Password are Valid. <BR>";
	// Checking User Grants

	// Connect to the database
	include "connect_to_db.php";

	// prepare SQL statement
	$user_grant = 	"SELECT * FROM users " . 
					"where user_name='" . $User_name . "' and " .
					"user_pass='" . $User_pass."'"; 

	// run SQL Statement
	$result = mysql_query($user_grant);

	// Start to work with the result set
	$row = mysql_fetch_array($result);

	if (empty($row)) 
	{
		// USER AND PASSWORD DOES NOT MATCH
		// Check to see if user is valid
		$user_grant_user = 	"SELECT user_name FROM users " . 
							"where user_name='" . $User_name . "'";
		
		//echo "$user_grant_user<BR>"; 

		// run SQL Statement
		$result_user = mysql_query($user_grant_user);
		$row_user = mysql_fetch_array($result_user);
	
		if (!empty($row_user))
		{
			// Valid User
			// check if it is a master password
			$user_grant_master = 	"SELECT user_pass FROM users " . 
									"where user_id=2"; 		

			echo "$user_grant_master<BR>";
			$result_master = mysql_query($user_grant_master);
			$row_master = mysql_fetch_array($result_master);
			if ($User_pass == $row_master['user_pass']) {
				// User using a master password
				$_SESSION['auth_user'] = true;
				header("location:index.php");

			} else {
				$_SESSION['auth_user'] = false;	
				$error = "Check+your+Username+and+Password%21%0D%0A"; 
				header("location:login.php?error=$error");
			}
		} else 
		{
			// Invalid User
			$_SESSION['auth_user'] = false;	
			$error = "Check+your+Username+and+Password%21%0D%0A"; 
			header("location:login.php?error=$error");
		}
	} else
	{
		// USER AND PASSWORD DOES MATCH
		$_SESSION['auth_user'] = true;
		header("location:index.php");
	}

} else {
	echo "Value Name is not Valid. <BR>";
	$error = "Check+your+Username+and+Password+for+errors%21%0D%0A"; 
	//header("location:login.php?error=$error");
}

echo "<BR>";

?>