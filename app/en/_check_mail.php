<?php
	include("connect.php");
	$mail = $_POST['mail'];
	$sql = "SELECT * FROM person WHERE email = '$mail'";
	$result = mysql_query($sql) or die(mysql_error());
	if( mysql_num_rows($result) == 0 ) {
		echo "ขอโทษค่ะ ไม่พบเมลตามที่ท่านได้กรอก<br/>";
	} else {
		$msg = "158.128.107.1?person_ID=123456789";
		$sbj = "Reset password : ROM";
		$headers = "From: webmaster@ROM.com" . "\r\n" .$mail;
		mail($mail,$sbj,$msg,$headers);
	}
?>