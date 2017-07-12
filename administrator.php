<?php 
    session_start();
    include("app/en/connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrator : Reserve system of Monk's house</title>
	<?php
		if( $_SESSION["personID"] == "" or $_SESSION["personID"] == "unknow" ) {
	        echo "<script>alert(\"กรุณาเข้าสู่ระบบก่อน\")</script>";
	        echo "redirecting";
	        echo "<script>window.location = 'app/login.php'</script>";
	    }
	?>
	<script src="app/jquery/jquery-2.1.4.min"></script>
	<script type="text/javascript">
		function toggle_table() {
			if(document.getElementById("table1").style.visibility != "visible")
				document.getElementById("table1").style.visibility = "visible";
			else
				document.getElementById("table1").style.visibility = "hidden";
		}

		function update_reserve() {
			var _date = $('#_date').val();
			if(_date != "") {
				$.ajax({
				    type: 'POST',
				    url: 'app/en/_unnew_reserv.php',
				    data: { 
				        'r_date': _date
				    },
				    success: function(data){
				    	document.getElementById("saved").innerHTML = "";
				        $('#showSuccessTxt').html(data);
				    }
				});
			} else {
				data_conf = "กรุณาเลือกวันที่";
				$('#showSuccessTxt').html(data_conf);
				document.getElementById("_date").focus();
				document.getElementById("showSuccessTxt").style.color = "red";
			}
		}
	</script>
</head>
<body>
	<div class="wrapper">
		<div class="menu_admin">
			<h4>จัดการข้อมูลฆราวาส</h4>
			<a href="app/manage_guest.php">จัดการข้อมูลฆราวาส</a>
		</div>
		<hr>
		<div class="menu_admin">
			<h4>การจัดการจอง</h4>
			<a href="app/manage_reserve.php">การจัดการจอง</a>
		</div>
		<hr>

		<div class="menu_admin">
			<h4>จัดการประเภทกุฏิ</h4>
			<a href="app/manage_house.php">จัดการประเภทกุฏิ</a>
		</div>
		<hr>

		<div class="menu_admin">
			<h4>ดูรายงาน</h4>
			<a href="#">ดูรายงาน</a>
		</div>
		<hr>

		<div class="menu_admin">
			<h4>การจัดการฟังก์ชั่นพิเศษ</h4>
			<?php
				if($_POST['delete_r'] == "ลบ") {
					$del = $_POST['r_date'];
					$del_sql = "DELETE FROM system WHERE job_date = '$del'";
					if(mysql_query($del_sql)) {
						echo "<script>window.location = 'administrator.php?success=suc'</script>";
					}
				}
			?>
			<?php
				$_date = date("Y-m-d");
				$sql = "SELECT * FROM system WHERE job_date = '$_date' ";
				$result = mysql_query($sql) or die(mysql_error());
				if(mysql_num_rows($result) == 0)
					echo "สถานะ : อนุญาติการจอง";
				else
					echo "สถานะ : ปิดการจอง";

			?>
				<br><input type="button" value="ดูตารางการปิด การจอง" onclick="toggle_table();">
				<?php
					if($_GET['success'] == "suc")
						echo "<b style=\"color : #4BED39;\" id=\"saved\">บันทึกข้อมูลสำเร็จ</b>";
						echo "<script>document.getElementById(\"table1\").style.visibility=\"visible\"</script>";
				?>
				<b style="color : #4BED39;" id="showSuccessTxt"></b>
				<table border="1" style="visibility:hidden" id="table1">
					<tr>
						<td>วันที่</td>
						<td>การดำเนินการ</td>
					</tr>
					<div id="table_reserve"></div>
					<?php
						$sql = "SELECT * FROM system";
						$result = mysql_query($sql) or die(mysql_error());
						while ($dbarr = mysql_fetch_array($result)) {
							echo "<form action=\"administrator.php\" method=\"POST\" >";
								echo "<tr>";
									echo "<td>$dbarr[0]</td>";
									echo "<input type=\"hidden\" name=\"r_date\" value=\"$dbarr[0]\">";
									echo "<td><input type=\"submit\" name=\"delete_r\" value=\"ลบ\"></td>";
								echo "</tr>";
							echo "</form>";
						}
					?>
					<tr>
						<td><input type="date" id="_date" value="$_date"></td>
						<td><input type="submit" name="turn_r_off" value="ปิดการจอง" onclick="update_reserve();"></td>
					</tr>
				</table>
		</div>

	</div>
</body>
</html>