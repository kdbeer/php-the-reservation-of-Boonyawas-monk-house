<?php
	session_start();
	include("connect.php");
    if( $_SESSION["personID"] == "" or $_SESSION["personID"] == "unknow" ) {
            echo "<script>alert(\"กรุณาเข้าสู่ระบบก่อน\")</script>";
            echo "redirecting";
            echo "<script>window.location = '../../app/login.php'</script>";
   	}
   	echo "<meta charset=\"utf-8\">";
   	$submit = $_POST['submit'];
   	if($submit == "ดูรายการนี้") {
   		$r_id = $_POST['r_id'];
   		$sql = "SELECT * FROM reserve WHERE house_Id = $r_id";
   		$result = mysql_query($sql);
   		echo "<a href=\"../../app/manage_house.php\"><input type=\"button\" value=\"ดูกุฏิอื่น\"></a>";
   		echo "<a href=\"../../app/manage_reserve.php\"><input type=\"button\" value=\"จัดการการจอง\"></a><br />";
   		echo "<table border=\"1\">";
   			echo "<tr>";
   				echo "<td>หมายเลขการจอง</td>";
   				echo "<td>วันปฏิบัติธรรม</td>";
   				echo "<td>วันที่สิ้นสุดการปฏิบัติธรรม</td>";
   			echo "</tr>";
   		while ($dbarr = mysql_fetch_array($result)) {
   			echo "<tr>";
   				echo "<td>$dbarr[1]</td>";
   				echo "<td>$dbarr[4]</td>";
   				echo "<td>$dbarr[5]</td>";
   			echo "</tr>";
   		}
   		echo "</table>";



   	} else if(isset($_GET['r_id'])) {
   		$r_id = $_GET['r_id'];
		$sql = "DELETE FROM house WHERE house_Id = $r_id";
		if(mysql_query($sql))
			echo "<script>window.location = '../../app/manage_house.php'</script>";
   	}
?>