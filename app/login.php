<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>เข้าสู่ระบบ : Reserv system of monk's house </title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<script src="jquery/common.js"></script>
	<script src="jquery/jquery-2.1.4.min"></script>
	<script type="text/javascript">
		function get_forget_pass() {
			$.ajax({
			    type: 'POST',
			    url: 'app/forget_password.php',
			    data: { 
			        'r_date': "_date"
				},
				success: function(data) {
			        $('#login_wrapper').html(data);
			    }
			});
		}
	</script>
</head>
<body>
	<div id="login_wrapper">
		<div class="login_header">
			<span class="name">R.O.M</span><br />
			<span class="th-name">ระบบของกุฏิ วัดบุญญาวาส</span>
		</div>
		<div class="content">
			<form action="app/en/login_en.php" method="POST">
				<div><img src="app/style/profile_login.png" width="20%" height="auto"></div>
				<input class="tbox" type="text" name="username" placeholder = "Username" required><br>
				<input class="tbox" type="password" name="password" placeholder = "Password" requirded><br>
				<input type="submit" class="btt" value="เข้าสู่ระบบ"><br />
				<a href="#" onclick="get_forget_pass()">ลืมรหัสผ่าน</a><a href="#" onclick="print_form_regis();" >Register</a><br />
				<input type="button" class="btt_facebook" value="เข้าสู่ระบบผ่าน Facebook">
			</form>
		</div>
	</div>
</body>
</html>