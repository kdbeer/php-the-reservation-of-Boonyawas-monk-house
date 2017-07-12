<?php
	session_start();
	include("connect.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM Person WHERE username = '$username' AND password = '$password'";
	$result = mysql_query($sql) or die(mysql_error());
	$numrow = mysql_num_rows($result);

	if($numrow == 0) {
		echo "Username or password incorrect please try again";
		$_SESSION['personID'] = "unknow";
		echo "<script>window.location = '../../index.php'</script>";
	}
	else {
		echo "redirecting";
		$p_id = mysql_fetch_array($result);
		$_SESSION["personID"] = $p_id[0];
		if($p_id[5] == "admin"){
			$_SESSION['group'] = "admin";
			echo "<script>window.location = '../../index.php'</script>";
		}
		else {
			$_SESSION['group'] = "user";
			echo "<script>window.location = '../../index.php'</script>";
		}
	}
?>