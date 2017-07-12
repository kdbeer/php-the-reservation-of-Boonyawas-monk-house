<!DOCTYPE html>
<html>
<head>
	<title>Test2</title>
	<script type="text/javascript">
		function testFunction() {
			var txt = document.getElementById("tst").value;
			document.getElementById("sp").innerHTML = txt;
		}
	</script>
</head>
<body>
	<form action="" name="f1" onsubmit="testFunction()">
		<input type="text" id="tst" required>
		<input type="submit">
	</form>
	<span id="sp"></span>
</body>
</html>
<?php

?>
