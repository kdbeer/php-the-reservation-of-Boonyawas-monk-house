<?php
	include("calendar_class.php");
	$cal = new call_calendar();

	$month_arr = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$month = $_POST['month'];
	$year = $_POST['year'];
	$mode = $_POST['mode'];
	$month = $month_arr[$month];

	if($mode == "user_house_reserve") {
		$cal->getCalendar("user_house_reserve",$month,$year);
	}

	if($mode == "user_view_reserve") {
		$cal->getCalendar("user_view_reserve",$month,$year);
	}

	


?>