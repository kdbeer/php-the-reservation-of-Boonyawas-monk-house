<?php 
	session_start(); 
	include("en/connect.php");
	include("require_login.php");
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
	<meta charset="utf-8">
	<title>สถิติ : Reserve system of Monk's house</title>
	<style>
		#f1:focus, #f1:active {
		    color: green;
		}

	</style>
	<script type="text/javascript">
		function show_year() {
			document.getElementById("syear").style.visibility = "visible";
			document.getElementById("year").style.visibility = "visible";
		}
		function hide_year() {
			document.getElementById("syear").style.visibility = "hidden";
			document.getElementById("year").style.visibility = "hidden";
		}
		function getfocus() {
		    document.getElementById("focusMe").focus();
		    document.getElementById("focusMe").style.color = "green";
		}
	</script>
</head>
<body>
	<div class="wrapper">
		<div class="head" id="focusMe">
			<form name="selection" action="statistic.php" method="POST" id="f1">
				เลือกประเภทที่อยากจะดู  : 
				<input type="radio" name="type" value="รายเดือน" id="jj" onclick="show_year();">รายเดือน
				<input type="radio" name="type" value="ไตรมาส" onclick="show_year();">ไตรมาส
				<input type="radio" name="type" value="รายปี" onclick="hide_year();">รายปี

				<b id="syear" style="visibility : hidden;">กรุณาเลือกปี : </b>
				<select name="get_c_year" id="year" style="visibility : hidden;" required>
					<?php
						// Get all year in reserve to show on selection below
						$year = "SELECT DISTINCT(YEAR(c_in_date)) FROM reserve";
						$result = mysql_query($year) or die(mysql_error());
						while($yearDB = mysql_fetch_array($result)) {
							if(date("Y") == $yearDB[0])
								echo "<option value=\"$yearDB[0]\" selected>".$yearDB[0]."</option>";
							else
								echo "<option value=\"$yearDB[0]\">".$yearDB[0]."</option>";
						}
					?>
				</select>
				<hr>

				<input type="submit" name="submit" value="แสดงรายการนี้">
			</form>
		</div>
		<div id="content">
			<table border="1">
				<?php
					if(isset($_POST["type"])) {
						echo "<h5>รายการแสดงผลประเภท : ".$_POST["type"]."<input type=\"button\" onclick=\"getfocus();\" value=\"เปลี่ยน\"></h5>";
					$get_c_year = $_POST["get_c_year"];
				 ?>
						
				<?php	echo "<tr>
								<td id=\"tag\"></td>
								<td>ห้องพักมากที่สุด</td>
								<td>จำนวนผู้เข้าพักเพศหญิง</td>
								<td>จำนวนผู้เข้าพักเพศชาย</td>
								<td>รวม (รายการ)</td>
							</tr>";

					}
					if($_POST["type"] ==  "รายเดือน" ) {
						$year = $_POST["c_year"];
						echo $year;
						$month = array("มกราคม","กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม");
						$i = 0;
						while ($i < 12) {
							$month_no = $i + 1;
							$sql = "SELECT count(r_id) FROM `reserve` WHERE MONTH(c_in_date) = '$month_no' AND YEAR(c_in_date) = '$get_c_year'";
							$_GET_COUNT = mysql_query($sql) or die(mysql_error());
							$_GET_COUNT = mysql_fetch_array($_GET_COUNT);


							//Get max 
							$query_max = "SELECT count(house_id) AS C, MAX(house_id) FROM reserve WHERE MONTH(c_in_date) = '$month_no' AND YEAR(c_in_date) = '$get_c_year' GROUP BY house_id DESC";
							$_get_max = mysql_query($query_max) or die(mysql_error());
							$_max = mysql_fetch_array($_get_max);

							//get reserve by woman
							$query_woman = "SELECT COUNT(R.r_id) FROM reserve AS R, person AS P WHERE P.Gender = 'หญิง' AND R.personID = P.nation_id AND MONTH(c_in_date) = '$month_no' AND YEAR(c_in_date) = '$get_c_year'";
							$_get_woman = mysql_query($query_woman) or die(mysql_error());
							$_woman = mysql_fetch_array($_get_woman);

							$query_man = "SELECT COUNT(R.r_id) FROM reserve AS R, person AS P WHERE P.Gender = 'ชาย' AND R.personID = P.nation_id AND MONTH(c_in_date) = '$month_no' AND YEAR(c_in_date) = '$get_c_year'";
							$_get_man = mysql_query($query_man) or die(mysql_error());
							$_man = mysql_fetch_array($_get_man);


							echo "<tr>";
								echo 	"<td>".$month[$i]."</td>";
										
								echo 	"<td>".$_woman[0]."</td>";
								echo 	"<td>".$_man[0]."</td>";
								echo 	"<td>".$_GET_COUNT[0]."</td>";
										if(mysql_num_rows($_get_max) == 0)
											echo "<td>ไม่มีรายการ</td>";
										else 
											echo "<td>".$_max[1]."</td>";
							echo "</tr>";
								$i++;
						}
						//$sql = "SELECT   ";
					}

					if($_POST["type"] ==  "ไตรมาส" ) {
						$i = 1;
						echo "<script>document.getElementById(\"tag\").innerHTML = \"ไตรมาส\"</script>";
						while ($i <= 3) {
							$t_m = $_POST['trimas'];
							if($i == 1)
								$t_m = "1 AND 4";
							else if($i == 2)
								$t_m = "5 AND 8";
							else if($i == 3)
								$t_m = "9 AND 12";
							
							$sql = "SELECT count(r_id) FROM `reserve` WHERE YEAR(c_in_date) = '$get_c_year' AND MONTH(r_date) BETWEEN ".$t_m;
							$_GET_COUNT = mysql_query($sql) or die(mysql_error());
							$_GET_COUNT = mysql_fetch_array($_GET_COUNT);


							//Get max 
							$query_max = "SELECT count(house_id) AS C, MAX(house_id) FROM reserve WHERE YEAR(c_in_date) = '$get_c_year' AND MONTH(r_date) BETWEEN ".$t_m." GROUP BY house_id DESC";
							$_get_max = mysql_query($query_max) or die(mysql_error());
							$_max = mysql_fetch_array($_get_max);

							//get reserve by woman
							$query_woman = "SELECT COUNT(R.r_id) FROM reserve AS R, person AS P WHERE YEAR(c_in_date) = '$get_c_year' AND P.Gender = 'หญิง' AND R.personID = P.nation_id AND MONTH(r_date) BETWEEN ".$t_m."";
							$_get_woman = mysql_query($query_woman) or die(mysql_error());
							$_woman = mysql_fetch_array($_get_woman);

							$query_man = "SELECT COUNT(R.r_id) FROM reserve AS R, person AS P WHERE YEAR(c_in_date) = '$get_c_year' AND P.Gender = 'ชาย' AND R.personID = P.nation_id AND MONTH(r_date) BETWEEN ".$t_m."";
							$_get_man = mysql_query($query_man) or die(mysql_error());
							$_man = mysql_fetch_array($_get_man);


							echo "<tr>";
								echo 	"<td>".$i."</td>";
										
								echo 	"<td>".$_woman[0]."</td>";
								echo 	"<td>".$_man[0]."</td>";
								echo 	"<td>".$_GET_COUNT[0]."</td>";
										if(mysql_num_rows($_get_max) == 0)
											echo "<td>ไม่มีรายการ</td>";
										else 
											echo "<td>".$_max[1]."</td>";
							echo "</tr>";
								$i++;
						}
						//$sql = "SELECT   ";
					}

					if($_POST["type"] ==  "รายปี" ) {
						echo "<script>document.getElementById(\"tag\").innerHTML = \"ปี\"</script>";
						$year = "SELECT  YEAR(c_in_date) FROM `reserve`ORDER BY  YEAR(c_in_date) LIMIT 0,1";
						$_get_year = mysql_query($year) or die(mysql_error());
						$min_year = mysql_fetch_array($_get_year);

						$year = "SELECT YEAR(c_in_date) FROM `reserve` ORDER BY YEAR(c_in_date) DESC LIMIT 0,1";
						$_get_year = mysql_query($year) or die(mysql_error());
						$max_year = mysql_fetch_array($_get_year);

						while ($min_year[0] <= $max_year[0]) {
							
							$sql = "SELECT count(r_id) FROM `reserve` WHERE YEAR(c_in_date) = '$min_year[0]'";
							$_GET_COUNT = mysql_query($sql) or die(mysql_error());
							$_COUNT = mysql_fetch_array($_GET_COUNT);

							$query_max = "SELECT count(house_id) AS C, MAX(house_id) FROM reserve WHERE YEAR(c_in_date) = '$min_year[0]' GROUP BY house_id DESC LIMIT 0,1";
							$_get_max = mysql_query($query_max) or die(mysql_error());
							$_max = mysql_fetch_array($_get_max);



							
							//get reserve by woman
							$query_woman = "SELECT COUNT(R.r_id) FROM reserve AS R, person AS P WHERE P.Gender = 'หญิง' AND R.personID = P.nation_id AND YEAR(c_in_date) = '$min_year[0]' ";
							$_get_woman = mysql_query($query_woman) or die(mysql_error());
							$_woman = mysql_fetch_array($_get_woman);

							$query_man = "SELECT COUNT(R.r_id) FROM reserve AS R, person AS P WHERE P.Gender = 'หญิง' AND R.personID = P.nation_id AND YEAR(c_in_date) = '$min_year[0]'";
							$_get_man = mysql_query($query_man) or die(mysql_error());
							$_man = mysql_fetch_array($_get_man);


							echo "<tr>";
								echo 	"<td>".$min_year[0]."</td>";
										
								echo 	"<td>".$_max[1]."</td>";
								echo 	"<td>".$_woman[0]."</td>";
								echo 	"<td>".$_man[0]."</td>";
								
								if(mysql_num_rows($_GET_COUNT) == 0)
										echo "<td>ไม่มีรายการ</td>";
								else 
										echo "<td>".$_COUNT[0]."</td>";
								
							echo "</tr>";
							$min_year[0]++;
						}
						//$sql = "SELECT   ";
					}

				?>
			</table>
		</div>
	</div>
</body>
</html>