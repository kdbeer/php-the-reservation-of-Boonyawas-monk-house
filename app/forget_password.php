<?php 
    session_start();
    include("en/connect.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ลืมรหัสผ่าน : Reserve system of Monk's house</title>
	<script src="jquery/jquery-2.1.4.min"></script>
	<script>
		function email_checking() {
			var x = $('#mail').val();
			$.ajax({
				type: 'POST',
				url: 'app/en/_check_mail.php',
				data: { 
					'mail': x
				},
				success: function(data){
				    $('#showTxt').html(data);
				}
			});
		}
	</script>
</head>
</head>
<body style="text-align : center">
	<div class="forget_pass_wrapper">
		<span class="name">ลืมรหัสผ่าน</span><br />
		<span class="th-name">กรุณาระบุที่อยูาอีเมล์ที่ถูกต้องที่ช่องด้านล่างนี้</span><br />
		<span class="th-name">ระบบจะทำการส่งการลิงค์เพื่อรีเซ็ตรหัสผ่านใหม่ ไปให้ค่ะ</span><br />
		<br /><br />
		<form action="forget_password.php" method="POST">
			<input type="email" id="mail" placeholder="example@example.com"><br />
			<span id="showTxt"></span>
			<input type="button" class="btt" id="submit" name="submit" onclick="email_checking()" value="SENT">
		</form>
	</div>
</body>
</html>