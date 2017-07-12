<?php
	session_start();
	include("connect.php");
	include_once("_CLASS_RESERVE.php");
	echo "<meta charset=\"UTF-8\">";
	$today 		= date("Y-m-d");
	$personID 	= $_POST['personID'];
	$r_id 		= $_POST['r_id'];
	$c_in_date 	= $_POST['c_in_date'];
	$c_out_date	= $_POST['c_out_date'];
	$c_in_time 	= $_POST['c_in_time'];
	$house_id 	= $_POST['house_id'];

/******************************************/
/*			Get header			          */
/******************************************/
	if(reserve::make_reservation($personID,$r_id,$house_id,$c_in_date, $c_out_date, $c_in_time)) {
		echo "<b>ดำเนินการจองเสร็จสิ้น</b>";
		echo "<br>";
		echo "<input type=\"button\" value=\"ดูประวัติการจอง\">";
	} else {
		echo "<b>ขออภัยค่ะ!! การจองล้มเหลว</b>";
		echo "<br>";
		echo "<input type=\"botton\" value=\"ลองใหม่\" onclick=\"_get_reserve(); init_date('user_house_reserve');\">";
	}
?>