<?php 
    session_start();
    include("en/connect.php");
    $person_ID = $_GET["person_ID"];
    if(!isset($person_ID))
    	echo "<script>alert(\"Bad request ไม่รู้จักผู้ใช้คนดังกล่าว\")</script>";
    else {
    	$getPerson = "SELECT * FROM person WHERE nation_id='$person_ID'";
    	$person = mysql_query($getPerson) or die(mysql_error());
    	if(mysql_num_rows($person) == 0) {
    		echo "<script>alert(\"Bad request ไม่รู้จักผู้ใช้คนดังกล่าว\")</script>";
    		echo "<script>window.location = 'login.php'</script>";
    	}
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reset password : Reserve system of Monk's house</title>
	<script type="text/javascript">
	function check_correct_pass() {
		var pass = document.getElementById("pass").value;
		var re_pass = document.getElementById("repass").value;
		if(pass == re_pass)
			document.getElementById("cleck_submit").disabled = false;
		else
			document.getElementById("cleck_submit").disabled = true;
	}

	function focus_input() {
		var pass = document.getElementById("pass").value;
		var re_pass = document.getElementById("repass").value;
		if(pass == re_pass)
			document.getElementById("repass").style.borderColor = "green";
		else
			document.getElementById("repass").style.borderColor = "red";
	}
	</script>
</head>
<body>
	<?php
		$submit = $_POST['submit'];
		if($submit == "submit") {
			$pass = $_POST['pass'];;
			$sql = "UPDATE person SET password='$pass' WHERE nation_id = '$person_ID')";
			if(mysql_query($sql)) {
				echo "<script>document.getElementById(\"show_result\").innerHTML = \"บันทึกข้อมูลสำเร็จแล้วค่ะ\"</script>";
			}
		}
	?>

	<form action="reset_pass.php" method="POST">
		<span id="show_result" style="color : green"></span>
		ใส่รหัสผาน :
		<input type="password" name="username" id="pass"><br /><br />
		ใส่รหัสผ่านอีกครั้ง  :
		<input type="password" name="password" id="repass" onchange="check_correct_pass();" onkeyup="focus_input();"><br /><br />
		<input type="submit" name="submit" id="cleck_submit" value="submit" disabled="true" >
	</form>

</body>
</html>