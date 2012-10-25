<?php
	date_default_timezone_set('America/Sao_Paulo');

	//connect to the database
	$link = mysql_connect("localhost", "root", "root")
		or die("Could not connect: " . mysql_error());
	
	mysql_select_db("moviesite", $link)
		or die (mysql_error());
	
	//make variables available
	$image_caption = $_POST['image_caption'];
	$image_username = $_POST['image_username'];
	$image_tempname = $_FILES['image_filename']['name'];
	$today = date("Y-m-d");

	//upload image and check for image type
	//make sure to change your path to match your images directory
	$ImageDir = "/Library/WebServer/Documents/PHP/MovieSite/images/";
	
	//**INSERT THIS LINE:
	$ImageThumb = $ImageDir . "thumbs/";
	//**END OF INSERT

	$ImageName = $ImageDir . $image_tempname;

	if (move_uploaded_file($_FILES['image_filename']['tmp_name'], $ImageName)) 
	{	
		//get info about the image being uploaded
		list($width, $height, $type, $attr) = getimagesize($ImageName);

		//**insert these new lines
		if ($type > 3) 
		{
			echo "Sorry, but the file you uploaded was not a GIF, JPG, or PNG file.<br>";
			echo "Please hit your browser’s ‘back’ button and try again.";
		} else 
		{
			//image is acceptable; ok to proceed
			//**end of inserted lines
			
			//insert info into image table
			$insert = 	"INSERT INTO images
						(image_caption, image_username, image_date) 
						VALUES 
						('$image_caption', '$image_username', '$today')";
			
			$insertresults = mysql_query($insert)
				or die(mysql_error());
			
			$lastpicid = mysql_insert_id();
			
			//change the following line:
			$newfilename = $ImageDir . $lastpicid . ".jpg";
			
			//**insert these lines
			if ($type == 2) {
				rename($ImageName, $newfilename);
			} else 
			{
				if ($type == 1) 
				{
					$image_old = imagecreatefromgif($ImageName);
				} elseif ($type == 3) 
				{
					$image_old = imagecreatefrompng($ImageName);
				}
			
				//”convert” the image to jpg
				$image_jpg = imagecreatetruecolor($width, $height);
				
				imagecopyresampled($image_jpg, $image_old, 0, 0, 0, 0, $width, $height, $width, $height);
				
				imagejpeg($image_jpg, $newfilename);
				
				imagedestroy($image_old);
				
				imagedestroy($image_jpg);
			}

			//**INSERT THESE LINES FOR THUMBNAILS
			$newthumbname = $ImageThumb . $lastpicid . ".jpg";
			
			//get the dimensions for the thumbnail
			$thumb_width = $width * 0.10;
			$thumb_height = $height * 0.10;
			
			//create the thumbnail
			$largeimage = imagecreatefromjpeg($newfilename);
			$thumb = imagecreatetruecolor($thumb_width, $thumb_height);
			
			imagecopyresampled($thumb, $largeimage, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
			
			imagejpeg($thumb, $newthumbname);
			
			imagedestroy($largeimage);
			
			imagedestroy($thumb);
			
			//**END OF INSERT

			$url = "Location: showimage.php?id=" . $lastpicid;
			header($url);
		}
	}
?>
<!-- Debuging Info 
<html>
<head>
<title>Check your Picture!</title>
</head>
<body>
<p>
< ?php
	echo "<a href=\"showimage.php?id=$lastpicid\">Click Here to Check Out Your Picture</a><BR>";
	echo "<BR> =============== Debugging Info =============== <BR>" ;
	echo "Image Caption: "	. $image_caption 	. "<BR>";
	echo "Image Username:" 	. $image_username 	. "<BR>";
	echo "Image Temp Name:"	. $image_tempname 	. "<BR>";
	echo "Today is:"		. $today 			. "<BR>" ;
	echo "Image Path:"		. $ImageDir 		. "<BR>";
	echo "Image Fullname:"	. $ImageName 		. "<BR>";
	echo "Image ID:	" 		. $lastpicid		. "<BR>";
	echo "Image New Name: " . $newfilename		. "<BR>";
	echo "Width = ". $width . "<BR> Height = ".  $height . "<BR> Type = " . $type . "<BR> Attr = " .  $attr . "<BR>";
?>
</p>
</body>
</html--> 