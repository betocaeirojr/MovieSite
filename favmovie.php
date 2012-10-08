<html>
<head>
	<title>My Movie Site</title>
</head>
<body>
	<?php include "header.php"; ?>
	<?php
		define ("FAVMOVIE", "The Life of Brian");
		echo "My favorite movie is ";
		echo FAVMOVIE;
	?>
	<?php include "footer.php"; ?>
</body>
</html>