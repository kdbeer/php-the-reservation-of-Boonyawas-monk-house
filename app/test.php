<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="Calendar.css">
</head>
<body>
	<?php
		include('Calendar.php');
		$Calendar = new SimpleCalendar();  
		$Calendar->setDate('Nov 2015');  
		$Calendar->show();
	?>
</body>
</html>