<?php
	include("connect.php");
	$mode = $_POST['mode'];
	if($mode == "del") {
		$id = $_POST['id'];
		$sql = "DELETE FROM system_event WHERE c_id = '$id'";
		if(mysql_query($sql)) {
			drawTable();
		} else {
			echo "ขออภัยค่ะ ไม่สามารถลบรายการนี้ได้".$id;
		}
	}

	if($mode == "toggle") {
		$id = $_POST['ids'];
		$sql = "SELECT * FROM system_event WHERE c_id = '$id'";
		$result = mysql_query($sql) or die(mysql_error());

		$status = mysql_fetch_array($result);

		if($status[4] == "active") {
			$sql_set = "UPDATE system_event SET status = 'inactive' WHERE c_id = '$id' ";
		} else {
			$sql_set = "UPDATE system_event SET status = 'active' WHERE c_id = '$id'";
		}

		if(mysql_query($sql_set) or die(mysql_error())) {
			drawTable();
		} else {
			echo "ไม่สามารถอัพเดทรายการนี้ได้ค่ะ";
		}
	}

	if($mode == "update_start") {
		$id = $_POST['ids'];
		$date = $_POST['date'];
		$sql = "UPDATE system_event SET start = '$date' WHERE c_id = '$id'";
		if(mysql_query($sql)) {
			drawTable();
		} else {
			echo "ไม่สามารถอัพเดทได้ค่ะ";
		}
	}

	if($mode == "update_cancel") {
		$id = $_POST['ids'];
		$date = $_POST['date'];
		$sql = "UPDATE system_event SET cancel = '$date' WHERE c_id = '$id'";
		if(mysql_query($sql)) {
			drawTable();
		} else {
			echo "ไม่สามารถอัพเดทได้ค่ะ";
		}
	}

	if($mode == "add_new") {
		$start 	= $_POST['start'];
		$date 	= $_POST['date'];
		$note 	= $_POST['note'];
		$sql 	= "INSERT INTO system_event VALUES('', '$start', '$date','$note', 'active')";
		if(mysql_query($sql) or die(mysql_error())) {
			drawTable();
		} else {
			echo "ไม่สามารถเพิ่มได้ค่ะ";
		}
	}


	function drawTable() { ?>
				<table class="turn_on">
					<tr class="header_trun_off">
						<td>วันที่</td>
						<td>วันที่ปิด</td>
						<td>ยกเลิกการปิด</td>
						<td>สาเหตุ</td>
						<td>สถานะ</td>
					</tr>
				<?php
					$sql = "SELECT c_id, start, cancel, LEFT (Notes, 5), status FROM system_event ORDER BY c_id DESC ";
					$result = mysql_query($sql) or die(mysql_error());
					$i = 0;
					while ($dbarr = mysql_fetch_array($result)) {
						if($i%2 == 0)
							echo "<tr class=\"tr_odd\">";
						else
							echo "<tr class=\"tr_even\">";

								echo "<td>".$dbarr[0]."</td>";
								echo "<td ><input type=\"date\" id=\"start\" value=\"$dbarr[1]\" onchange=\"update_start(".$dbarr[0].")\"></td>";
								echo "<td ><input type=\"date\" id=\"cancel\" value=\"$dbarr[2]\" onchange=\"update_cancel(".$dbarr[0].")\"></td>";
								echo "<td>".$dbarr[3]."</td>";
								if(date("Y-m-d") >= $dbarr[2] )
									echo "<td><a onclick=\"deleteThisEvent(".$dbarr[0].")\" class=\"del\" href=\"#\"></a></td>";
								else {
									if($dbarr[4] != "active")
										echo "<td><a href=\"#\" class=\"unactives\" onclick=\"toggleThis(".$dbarr[0].")\"></a></td>";
									else
										echo "<td><a href=\"#\" class=\"active\" onclick=\"toggleThis(".$dbarr[0].")\"></a></td>";
								}
						
							echo "</tr>";
						$i++;
					}
				?>
				</table>
<?php	}

?>