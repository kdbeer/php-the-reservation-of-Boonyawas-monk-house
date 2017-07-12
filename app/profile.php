	<?php 
    session_start();
    include("en/connect.php");
    include("require_login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ประวัติส่วนตัว : Reserve system of Monk's house</title>
</head>
<body>
	<div class="wrapper">
		<div class="profile_main">
			<h2>ประวัติส่วนตัว</h2>
			<hr>
			<?php 
				$_personID = $_SESSION["personID"];
				$query = "SELECT * FROM guest as G, person AS P WHERE P.nation_id = G.nation_ID AND G.nation_ID = '$_personID'";
				$_get_date = mysql_query($query) or die(mysql_error());
				$_data = mysql_fetch_array($_get_date);
			?>
			<table>
				<tr>
					<td><h3><?php echo $_data[1]." ".$_data[2];?></h3></td>
				</tr>
				<tr>
					<td>Nation</td>
					<td><?php echo $_data[0]; ?></td>
				</tr>
				<tr>
					<td>เพศ</td>
					<td><?php echo $_data[9]; ?></td>
				</tr>
				<tr>
					<td>วันเกิด</td>
					<td><?php echo $_data[3]; ?></td>
				</tr>
				<tr>
					<td>สิทธิ</td>
					<td><?php echo $_data[10]; ?></td>
				</tr>
				<tr>
					<td>หมายเลขโทรศัพท์</td>
					<td><?php echo $_data[4]; ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?php echo $_data[8]; ?></td>
				</tr>

			</table>
		</div>
		<div class="container">
			<hr>
			<?php
				$query2 = "SELECT * FROM address WHERE id = $_personID";
				$_get_data2 = mysql_query($query2) or die(mysql_error());
				if(mysql_num_rows($_get_data2) == 0) {
					echo "<a href=\"_set_address.php\">คุณยังไม่มีประวัติส่วนตัวเลย เพิ่มประวัติส่วนตัวสิ</a>";
				} else {
					$_data2 = mysql_fetch_array($_get_data2);
					echo "<table>";
						echo "<tr>";
							echo "<td>บ้านเลขที่</td>";
							echo "<td>".$_data2[1]."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>ตำบล</td>";
							echo "<td>".$_data2[2]."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>อำเภอ</td>";
							echo "<td>".$_data2[3]."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>จังหวัด</td>";
							echo "<td>".$_data2[4]."</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td>รหัสไปรษณีย์</td>";
							echo "<td>".$_data2[5]."</td>";
						echo "</tr>";
					echo "</table>";
				}

			?>
			
		</div>
	</div>

</body>
</html>