<?php 
	session_start();
	$_SESSION["personID"] = "unknow";
	
	if($_SESSION["personID"] == "unknow")
		echo "You're log out na";
	else
		echo "Cannot destroy a session";
	echo "<br />".$_SESSION["personID"];

	echo "redirecting";
	echo "<script>window.location = '../../index.php'</script>";
	
?>
