<?php
	session_start();
	include("connect.php");
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
	<title></title>
</head>
<body>
<?php
   	$r_id = $_POST['r_id'];
   	$r_house = $_POST['house_id'];
   	$r_cin = $_POST['r_cin'];
   	$r_cout = $_POST['r_cout'];

   	$sql = "UPDATE reserve SET house_id = '$r_house', c_in_date = '$r_cin', c_out_date = '$r_cout' WHERE r_id = '$r_id'";
   	if(mysql_query($sql)) {
   		echo "<script>alert(\"การจองสำเร็จ\")</script>";
   		echo "<script>window.location = '../../app/get_history.php'</script>";
   	} else {
   		echo "Cannot change reserve";
   	}
?>
</body>
</html>
   	