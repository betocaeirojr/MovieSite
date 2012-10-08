<?php
	
	// set default time zone
	date_default_timezone_set('America/Sao_Paulo');
	setlocale(LC_ALL, pt_BR);

	// get localtime
	$HourOfDay = strftime("%H");
	echo "The current hour of day is: $HourOfDay";
	
	
	// if time between 0:00 and 5:59 > Early Morning
	// if time between 6:00 and 11:59 > Morning
	// if time between 12:00 and 17:59 > Afternoon
	// if time between 18:00 and 23:59 > Night
	if (($HourOfDay >= 0 ) AND ($HourOfDay <=5)) 
	{
		echo "It's morning, but still dark! What the hell you are doing awake?!\n";

	} elseif (($HourOfDay>5) AND ($HourOfDay <=12)) 
		{
			echo "Good Morning!\n";

		} elseif (($HourOfDay>12) AND ($HourOfDay <=18)) 
			{
				echo "Good Afternoon!\n";
			} else 
				{
					echo "Good night, and good sleeping!\n";
				}



?>