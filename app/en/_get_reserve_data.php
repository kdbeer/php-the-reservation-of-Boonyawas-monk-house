<!DOCTYPE html>
<html>
<body>
<?php
	include("connect.php");
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$month+=1;
	$date = $year."-".$month."-".$day;

	echo "<div class=\"card\">";
	$sql = "SELECT * FROM reserve WHERE '$date'  BETWEEN c_in_date AND c_out_date";
	$result = mysql_query($sql) or die(mysql_error());

	echo "<div class='header_calendar'>ตารางการจองกุฏิประจำวันที่ $date</div>";

	while($dbarr = mysql_fetch_array($result)) {
			echo "<div class=\"cards\">";
				echo "<div class=\"left\">";
					echo "<div class=\"frame\"><div class=\"img\"><img src=\"img/home/bunyawas.png\"></div></div>";
					echo "<div class=\"house_id\">กุฏิหมายเลข  ".$dbarr[2]."</div>";
					echo "<div class=\"reserve_id\">การจองหมายเลข ".$dbarr[1]."</div>";
				echo "</div>";
				echo "<div class=\"right\">";
			?>
			<table>
				<tr>
					<td class="tag">วันที่ทำการจอง</td>
					<td class="dates"><?php echo $dbarr[4]; ?></td>
				</tr>
				<tr>
					<td class="tag">วันที่เข้าปฏิบัติธรรม</td>
					<td class="dates"><?php echo $dbarr[4]; ?></td>
				</tr>
				<tr>
					<td class="tag">วันที่ยกเลิกการปฏิบัติธรรม</td>
					<td class="dates"><?php echo $dbarr[4]; ?></td>
				</tr>
			</table>
	
	<?php		echo "</div>";
				echo "<div class=\"clear\"></div>";
			echo "</div>";
	}
	echo "<div class=\"clear\"></div>";
	echo "</div>";
?>
</body>
</html>