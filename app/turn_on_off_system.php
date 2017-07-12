<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="app/style/manage_system.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript">
		function deleteThisEvent(id) {
			$.ajax({
                type: 'POST',
                url: 'app/en/_edit_system.php',
                data: {
                     'mode'   	: "del",
                     'id'		: id
               },
               success: function(data) {
                  $('#wrapper_turn_off_table').html(data)
                }
            });
		}

		function toggleThis(id) {
			$.ajax({
                type: 'POST',
                url: 'app/en/_edit_system.php',
                data: {
                     'mode'   	: "toggle",
                     'ids'		: id
               },
               success: function(data) {
                  $('#wrapper_turn_off_table').html(data)
                }
            });
		}

		function update_start(id) {
			var date = $('#start').val();
			$.ajax({
                type: 'POST',
                url: 'app/en/_edit_system.php',
                data: {
                     'mode'   	: "update_start",
                     'ids'		: id,
                     'date'		: date
               },
               success: function(data) {
                  $('#wrapper_turn_off_table').html(data)
                }
            });
		}

		function update_cancel(id) {
			var start = $('#start').val();
			var date = $('#cancel').val();
			if(date > start) {
				$.ajax({
	                type: 'POST',
	                url: 'app/en/_edit_system.php',
	                data: {
	                     'mode'   	: "update_cancel",
	                     'ids'		: id,
	                     'date'		: date
	               },
	               success: function(data) {
	                  $('#wrapper_turn_off_table').html(data)
	                }
	            });
			} else {
				alert("วันที่ยกเลิอกมากกว่ามันเริ่มต้น กรุณาเลือกวันที่ให้ถูกต้องด้วยค่ะ")
			}
		}

		function addThis() {
			var start 	= $('#add_start').val();
			var date 	= $('#add_cancel').val();
			var note 	= $('#note').val();
			if(start != "" && date != "") {
				if(date > start) {
					$.ajax({
		                type: 'POST',
		                url: 'app/en/_edit_system.php',
		                data: {
		                     'mode'   	: "add_new",
		                     'start'	: start,
		                     'date'		: date,
		                     'note'		: note
		               },
		               success: function(data) {
		                  $('#wrapper_turn_off_table').html(data)
		                }
		            });
				} else {
					alert("วันที่ยกเลิอกมากกว่ามันเริ่มต้น กรุณาเลือกวันที่ให้ถูกต้องด้วยค่ะ")
				}
			} else {
				alert("คุณต้องกรอกวันที่");
			}
		}
	</script>
</head>
<body>
<?php
	include("en/connect.php");
	$sql = "SELECT * FROM system_event ";
	$get_list = mysql_query($sql) or die(mysql_error());
	if($dbarr = mysql_fetch_array($get_list)) { ?>
		<div id="wrapper_turn_off" >
			<div class="head">เพิ่มการเปิด/ปิด ใหม่</div>
			<div id="add_new">
				<table>
					<tr class="header_trun_off">
						<td>วันที่ปิด</td>
						<td>ยกเลิกการปิด</td>
						<td>สาเหตุ</td>
						<td></td>
					</tr>
					<tr class="tr_odd">
						<td><input type="date" id="add_start" class="cancel"></td>
						<td><input type="date" id="add_cancel" class="cancel"></td>
						<td><input type="text" id="note"></td>
						<td><a href="#" onclick="addThis()">เพิ่ม</a></td>
					</tr>
				</table>
			</div>
			<div class="head">จัดการระบบ</div>
			<div id="wrapper_turn_off_table">
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
			</div>
	</div>

<?php	}
?>
</body>
</html>