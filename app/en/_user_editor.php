<?php
	include("en/connect.php");
    if( $_SESSION["personID"] == "" or $_SESSION["personID"] == "unknow" ) {
            echo "<script>alert(\"กรุณาเข้าสู่ระบบก่อน\")</script>";
            echo "redirecting";
            echo "<script>window.location = '../../app/login.php'</script>";
   	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>แก้ไขประวัติส่วนตัว : Reserve system OF monk's house</title>
</head>
<body>

</body>
</html>