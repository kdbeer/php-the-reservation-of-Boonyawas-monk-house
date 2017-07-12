<?php
	session_start();
	if($_SESSION['group'] != "logged") {
		echo "<script>alert(\"Please log in\")</script>";
		echo "<script> window.location = 'test_session_2.php'</script>";
	}

?>