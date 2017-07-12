<?php
	session_start();
	include("connect.php");
    if( $_SESSION["personID"] == "" or $_SESSION["personID"] == "unknow" ) {
            echo "<script>alert(\"กรุณาเข้าสู่ระบบก่อน\")</script>";
            echo "redirecting";
            echo "<script>window.location = '../../app/login.php'</script>";
   	}
   	echo "<meta charset=\"utf-8\">";
	$r_date = $_POST['r_date'];
	$sql = "INSERT INTO system VALUE('$r_date', 'ปิด')";
	if(mysql_query($sql)) {
		echo "บันทึกข้อมูลสำเร็จแล้ว";
	}

?>