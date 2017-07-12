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
	<title>แก้ไขประวัติส่วนตัว : Reserve system OF monk's house</title>
</head>
<body>
	<?php
		$r_id = $_POST['r_id'];
		$delete = $_POST['delete'];
		$update = $_POST['update'];
		$personID = $_SESSION['personID'];

		$r_name = $_POST['r_name'];
		$r_date = $_POST['r_date'];
		$r_house = $_POST['r_house'];
		$r_cin = $_POST['r_cin'];
		$r_time = $_POST['r_time'];
		$r_cout = $_POST['r_cout'];


		if(isset($delete)){
			$sql = "DELETE FROM reserve WHERE r_id = '$r_id'";
			$result = mysql_query($sql) or die(mysql_error());
			echo "<script>alert(\"Delete succesful\")</script>";
			echo "<script>window.location = '../../app/get_history.php'</script>";
		} else if (isset($update)) { ?>
			

			<hr>
			<h5>การแก้ไขประวัติการจอง</h5>
			<br /><br />
			<form action="_update_user_reserve.php" method="POST">
				<table border="1">
					<?php
						$sql = "SELECT person.Gender, guest.name FROM guest, person WHERE person.nation_ID = guest.nation_ID AND guest.nation_ID = '$personID'";
						$_get_gender = mysql_query($sql) or die(mysql_error());
						$_h_type = mysql_fetch_array($_get_gender);
					?>
					<tr>
						<td>หมายเลขการจอง</td>
						<td>
							<?php 
								echo $r_id;
								echo "<input type=\"hidden\" name=\"r_id\" value=\"$r_id\">";
							?>
						</td>
					</tr>
					<tr>
						<td>ผู้จอง</td>
						<?php echo "<td>".$_h_type[1]."</td>"; ?>
					</tr>
					<tr>
						<td>วันที่จอง</td>
						<?php echo "<td>".$r_date."</td>"; ?>
					</tr>
					<tr>
						<td>กุฏิที่จอง</td>
						<?php
							$_h_type = $_h_type[0];
							$sql = "SELECT * FROM house WHERE type = \"$_h_type\" AND house_Id NOT IN (SELECT house_id FROM `reserve` WHERE c_in_date = '$_date')";
							$_get_house = mysql_query($sql) or die(mysql_error());
							echo "<td>";
							echo "<select name = \"house_id\">";
								while($db_house  = mysql_fetch_array($_get_house)) {
									echo "<option value=\"$db_house[0]\">หลังที่ : ".$db_house[0]."</option>";
								}
							echo "</select>";
							echo "<td>";
						?>
					</tr>
					<tr>
						<td>วันที่เข้าพัก</td>
						<?php echo "<td><input name=\"r_cin\" type=\"date\" value=\"$r_cin\"></td>"; ?>
					</tr>
					<tr>
						<td>ช่วงเวลาที่เข้าพัก</td>
						<?php 
							if($r_time == 0)
								echo "<td>เช้า</td>";
							else if($r_time == 1)
								echo "<td>บ่าย</td>";
						 ?>
					</tr>
					<tr>
						<td>วันที่ยกเลิกการพัก</td>
						<?php
							echo "<td><input name = \"r_cout\" type=\"date\" value=\"$r_cout\"></td>";
						?>
					</tr>
				</table>
				<input type="submit" name="update" value="ยันยันการแก้ไข">
			</form>
	<?	
		}
	?>
</body>
</html>