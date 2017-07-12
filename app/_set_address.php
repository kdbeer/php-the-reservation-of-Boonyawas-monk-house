<?php 
    session_start();
    include("en/connect.php");
    include("require_login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>เพิ่มที่อยู่ : Reserve system of Monk's house</title>
</head>
<body>
	<?php
		if($_POST['submit'] ==  "เพิ่มที่อยู่นี้") {
			$_personID = $_SESSION['personID'];
			$a_id = $_POST['a_id'];
			$v_id = $_POST['v_id'];
			$c_id = $_POST['c_id'];
			$p_id = $_POST['p_id'];
			$zip = $_POST['zip'];


			$sql = "INSERT INTO address VALUES ('$_personID', '$a_id', '$v_id', '$c_id', '$p_id', '$zip')";
			if(mysql_query($sql)) {
				echo "<script>alert(\"บันทึกข้อมูลสำเร็จแล้ว\")</script>";
			    echo "redirecting";
			    echo "<script>window.location = 'profile.php'</script>";
			}
		}
	?>
		<form action="_set_address.php" method="POST">
		<h3>เพิ่มที่อยู่ใหม่</h3>
		ผู้ใช้หมายเลข : <?php echo $_SESSION['personID']; ?>
		<table>
			<br /><br />
			<tr>
		      <td><label for="TelNo">บ้านเลขที่ : </label></td>
		      <td><input type="text" name="a_id" />
		      </td>
		    </tr>
		    <tr>
		      <td><label for="TelNo">ตำบล : </label></td>
		      <td><input type="text" name="v_id" />
		      </td>
		    </tr>
		    <tr>
		      <td><label for="TelNo">อำเภอ : </label></td>
		      <td><input type="text" name="c_id" />
		      </td>
		    </tr>
		    <tr>
		      <td><label for="TelNo">จังหวัด : </label></td>
		      <td><input type="text" name="p_id" />
		      </td>
		    </tr>
		    <tr>
		      <td><label for="TelNo">รหัสไปรษณีย์ : </label></td>
		      <td><input type="text" name="zip" />
		      </td>
		    </tr>
		</table>
		<input type="submit" name="submit" value="เพิ่มที่อยู่นี้">
	</form>
</body>
</html>