<?php

	session_start(); 
	include("connect.php");

	$house_id = $_POST['house_id'];
	$r_id = $_POST['r_id'];
	$personID = $_POST['personID'];
	$r_date = $_POST['r_date'];
	$c_in_date = $_POST['c_in_date'];
	$c_out_date = $_POST['c_out_date'];
	$c_in_time = $_POST['c_in_time'];

	echo "1 : ".$house_id."<br />";
	echo "2 : ".$r_id."<br />";
	echo "3 : ".$personID."<br />";
	echo "4 : ".$r_date."<br />";
	echo "5 : ".$c_in_date."<br />";
	echo "6 : ".$c_out_date."<br />";
	echo "7 : ".$c_in_time."<br />";

	$sql = "INSERT INTO reserve VALUES('$personID', '$r_id', '$house_id', '$r_date', '$c_in_date', '$c_out_date', '$c_in_time', '$c_in_time')";
	if($result = mysql_query($sql) or die(mysql_error()))
		echo "<script>window.location = '../../index.php';</script>";
	else
		echo "Cannot insert data";


?>