<?php 
	session_start(); 
	include("en/connect.php");
	include("require_login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>การของกุฏิ : Reserve system of monk's house</title>
</head>
<body>
	<?php
		$personID = $_SESSION[personID];
		$_date = $_GET['_date'];
		$sql = "SELECT * FROM reserve WHERE c_in_date = '$_date'";
		$result_arr = mysql_query($sql) or die(mysql_error());
		$sql2 = "SELECT * FROM person WHERE nation_ID = '$personID'";
		$_get_person_data = mysql_query($sql2) or die(mysql_error());
		$_person_data = mysql_fetch_array($_get_person_data);
	?>
	<form name="_regis_house" action="en/_set_regis.php" method="POST">
		<?php
			//User select house here
			echo "<br />เลือกกุฏิ : ";
			$sql = "SELECT * FROM house WHERE  type = '$_person_data[4]' AND house_Id NOT IN (SELECT house_id FROM `reserve` WHERE c_in_date = '$_date')";
			$_get_house = mysql_query($sql) or die(mysql_error());
			echo "<select name = \"house_id\">";
				while($db_house  = mysql_fetch_array($_get_house)) {
					echo "<option value=\"$db_house[0]\">หลังที่ : ".$db_house[0]."</option>";
				}
			echo "</select><br /><br />";
			
			//get Reserve id and make sure it will not duplicate with another field
			$sql = "SELECT r_id FROM reserve ORDER BY r_id DESC";
			$_get_rid = mysql_query($sql) or die(mysql_error());
			$r_id = mysql_fetch_array($_get_rid);
			$r_id = $r_id[0] + 1;
			echo "<input type =\"hidden\" name=\"r_id\" value=\"$r_id\">";
			echo"การจองหมายเลขที่ : ".$r_id."<br /><br />";

			//get person id
			echo "<input type =\"hidden\" name=\"personID\" value=\"$_SESSION[personID]\">";
			echo"การจองหมายเลข : ".$_SESSION[personID]."<br /><br />";

			// get reserve date
			$r_date = date("Y-m-d");
			echo "<input type =\"hidden\" name=\"r_date\" value=\"$r_date\">";
			echo "วันที่จองคือ  : " .date("Y-m-d")."<br /><br />";

			//get check in date date
			echo "<input type =\"hidden\" name=\"c_in_date\" value=\"$_date\">";
			echo "วันที่เข้าพักคือ : ".$_date."<br /><br />";

			//get check out date
			echo "กรุณาเลือกวันที่ Check out : <br />";
			echo "<input type =\"date\" name=\"c_out_date\">";
			echo "<br /><br />";

			//get time to check in
		?>
			กรุณาเลือกเวลาเข้าพัก  : <br />
			<select name="c_in_time">
				<option value="0">เช้า</option>
				<option value="1">บ่าย</option>
			</select>

			<br /><br />
			<input type="submit" name="submit" value="ยืนยันการเลือก">

	</form>
	
</body>
</html>