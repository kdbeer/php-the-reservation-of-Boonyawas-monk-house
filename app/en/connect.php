<?
	$hostname = "localhost";
	$username = "root";
	$password = "1234";
	$dbname = "sedb15_10";
	$conn =mysql_connect($hostname,$username,$password) or die (mysql_error());
	mysql_select_db($dbname) or die (mysql_error("Cannot access database : code2"));
	mysql_query("SET NAMES UTF8");
?>