<?php 
	include('Calendar.php');
	$month_arr = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$month = $_POST['month'];
	$year = $_POST['year'];
	$Calendar = new SimpleCalendar(); 
	$date_set = $month_arr[$month]." ".$year;
	$Calendar->setDate($date_set);  
	$Calendar->show();
?>