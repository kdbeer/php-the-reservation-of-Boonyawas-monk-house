<?php 
    session_start();
    include("en/connect.php");
    include("en/_person_class.php");
    $personID = $_SESSION['personID'];
    $newPerson = new person($personID);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/Calendar.css">
	<link rel="stylesheet" type="text/css" href="style/show_calendar.css">
</head>
<body>
	<div class="get_reservelist_wrapper">
		<div class="reserve_navigation">
			<div class="header_name">
				การดูประวัติการจอง
			</div>
        </div>
		<div class="left_side">
			<div class="left_container">
				<div class="left_head_name">
					ประวัติการจอง
				</div>
				<hr>
				<table class="history_table">
					<tr>สวัสดี <?php echo $newPerson->get_name(); ?></tr>
					<tr>
						<td>สถานะการจอง : </td>
						<td><?php 
							if($newPerson->get_reserveable())
								echo "สามารถจองได้";
							else
								echo "ไม่มีสิทธ์จอง";
							?> 
						</td>
					</tr>
					<tr>
						<td>การจองทั้งหมด  </td>
						<td><?php echo $newPerson->get_reserve_count(); ?> ครั้ง</td>
					</tr>
					<tr>
						<td>การจองครั้งล่าสุด  </td>
						<td><?php 
							echo $newPerson->get_lastIn(); ?> 
						</td>
					</tr>
					<tr>
						<td>การจองทั้งหมด  </td>
						<td><?php echo $newPerson->get_count_reserve(); ?> วัน</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="right_side">
			<div class="history_container">
				<table border="1" style="text-align : center; box-shadow:none;">
					<tr class="table_head">
						<td>วันที่จอง</td>
						<td>กุฏิที่จอง</td>
						<td>วันที่เข้าพัก</td>
						<td>ช่วงเวลาที่เข้าพัก</td>
						<td>วันที่ยกเลิกการพัก</td>
					</tr>
				<?php
					$sql = "SELECT * FROM Reserve WHERE personID = '$personID'";
					$result = mysql_query($sql) or die(mysql_error());
					$i = 1;
					while($dbarr = mysql_fetch_array($result)) {
							if($i % 2 != 0)
								echo "<tr class=\"odd\">";
							else
								echo "<tr class=\"even\">";
								echo "<td>".$dbarr[3]."</td>";
								echo "<td>".$dbarr[2]."</td>";
								echo "<td>".$dbarr[4]."</td>";
								if($dbarr[6] == 0)
									echo "<td>เช้า</td>";
								else if($dbarr[6] == 1)
									echo "<td>บ่าย</td>";
								echo "<td>".$dbarr[5]."</td>";
							echo "</tr>";
							$i++;
					}
				?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>