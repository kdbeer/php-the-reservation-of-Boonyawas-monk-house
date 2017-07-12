<?php 
    session_start();
    include("en/connect.php");
    include("en/_person_class.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="app/style/admin_style.css">
	<script type="text/javascript">

		function update_personal() {
			var upload_user_ok 	= 1;
			var get_nation_id 	= $('#get_nation_id').val();	if(get_nation_id == "") upload_user_ok = 0;
			var get_username 	= $('#get_username').val();		if(get_username == "") 	upload_user_ok = 0;
			var get_name 		= $('#get_name').val();			if(get_name == "") 		upload_user_ok = 0;
			var get_surname 	= $('#get_surname').val();		if(get_surname == "") 	upload_user_ok = 0;
			var get_telNo 		= $('#get_telNo').val();		if(get_telNo == "") 	upload_user_ok = 0;
			var get_Gender 		= $('#get_Gender').val();		if(get_Gender == "") 	upload_user_ok = 0;
			var get_priv 		= $('#get_priv').val();			if(get_priv == "") 		upload_user_ok = 0;
			var get_email 		= $('#get_email').val();		if(get_email == "") 	upload_user_ok = 0;

			if(upload_user_ok == 1) {
					$.ajax({
				    type: 'POST',
				    url: 'app/en/_edit_guest.php',
				    data: {
				        'id'		: get_nation_id,
				        'username'	: get_username,
				        'name'		: get_name,
				        'surname'	: get_surname,
				        'telno'		: get_telNo,
				        'email'		: get_email,
				        'Gender'	: get_Gender,
				        'priv'		: get_priv,
				        'mode'		: 'update'
					},
					success: function(data) {
					    document.getElementById("popup_person_data").style.display = "block";
					    $('#update_msg').html(data);
				    }
				});
			}
		}

		function search_guest() {
			var search = $('#g_search').val();
			$.ajax({
				    type: 'POST',
				    url: 'app/en/_edit_guest.php',
				    data: {
				        'telNo'		: search,
				        'mode'		: 'search'
					},
					success: function(data) {
					    $('#search_show').html(data);
				    }
				});
		}

		function add_new() {
			var add_user_ok 	= 1;
			var add_nation_id 	= $('#add_nation_ID').val();	if(add_nation_id == "") add_user_ok = 0;
			var add_username 	= $('#add_username').val();		if(add_username == "") 	add_user_ok = 0;
			var add_name 		= $('#add_name').val();			if(add_name == "") 		add_user_ok = 0;
			var add_surname 	= $('#add_surname').val();		if(add_surname == "") 	add_user_ok = 0;
			var add_telNo 		= $('#add_telNo').val();		if(add_telNo == "") 	add_user_ok = 0;
			var add_Gender 		= $('#add_Gender').val();		if(add_Gender == "") 	add_user_ok = 0;
			var add_priv 		= $('#add_priv').val();			if(add_priv == "") 		add_user_ok = 0;
			var add_email 		= $('#add_email').val();		if(add_email == "") 	add_user_ok = 0;
			var add_username 	= $('#add_username').val();		if(add_username == "") 	add_user_ok = 0;
			var add_password 	= $('#add_password').val();		if(add_password == "") 	add_user_ok = 0;
			var add_dob			= $('#add_dob').val();		if(add_dob == "") 		add_user_ok = 0;
			/*if(add_user_ok == 0) {
				$('#add_msg').html("ข้อมูลไม่ถูกต้อง โปรตรวจสอบข้อมูล");
			} else {*/
				//if(upload_user_ok == 1) {
						$.ajax({
					    type: 'POST',
					    url: 'app/en/_edit_guest.php',
					    data: {
					        'id'		: add_nation_id,
					        'username'	: add_username,
					        'password'	: add_password,
					        'name'		: add_name,
					        'surname'	: add_surname,
					        'telno'		: add_telNo,
					        'email'		: add_email,
					        'Gender'	: add_Gender,
					        'priv'		: add_priv,
					        'dob'		: add_dob,
					        'mode'		: 'add_new'
						},
						success: function(data) {
						    $('#add_msg').html(data);
					    }
					});
				//}
			//}
		}
	</script>
</head>
<body>
	<div id = "popup_person_data">
		<div class="popup_containner" id="popup_containner">
			<div class="exit_bar"><img src="app/style/cross.png" onclick="hide_popup()"></div>
			<div id="popup_content"></div>
		</div>
	</div>
	<div class="manage_guest_wrapper">
		<div class="left_side">
				<div class="left_side_name">
					เพิ่มผู้จอง : <span style="color:#F3780C;font-size:0.8em;" id="add_msg"></span>
			 	</div>
				<hr>

					<table>
						<tr>
							<td><input type="text" id="add_nation_ID" placeHolder="เลขบัตรประจำตัวประชาชน" ></td>
						</tr>
						<tr>
							<td><input type="text" id="add_name" placeHolder="ชื่อ" ></td>
						</tr>
						<tr>
							<td><input type="text" id="add_surname" placeHolder="สกุล" ></td>
						</tr>
						<tr>
							<td><lebel>วันเกิด</lebel></td>
						</tr>
						<tr>
							<td><input type="date" id="add_dob" ></td>
						</tr>
						<tr>
							<td><input type="text" id="add_telNo"  placeHolder="เบอร์โทรศัพท์" ></td>
						</tr>
						<tr>
							<td><input type="email" id="add_email" placeHolder="E-mail" ></td>
						</tr>
						<tr>
							<td>เพศ</td>
						</tr>
						<tr>
							<td>
								<select id="add_Gender">
									<option value="ชาย">ชาย</option>
									<option value="หญิง">หญิง</option>
								</select>
							</td>
						</tr>
						<tr><td><hr></td></tr>
							<tr>
								<td><input type="text" id="add_username" placeholder="Username" ></td>
							</tr>
							<tr>
								<td><input type="text" id="add_password" placeholder="password" >
							</td>
							<tr><td>กลุ่มผู้ใช้</td></tr>
							<tr>
								<td>
									<SELECT id="add_priv">
										<option value="user">ผู้จอง</option>
										<option value="admin">ผู้ดูแลระบบ</option>
									</SELECT>
								</td>
							</tr>
						<tr><td><hr></td></tr>

						<tr>
							<td><input type="button" onclick="add_new()" value="เพิ่มผู้จอง"></td>
						</tr>
					</table>
		</div>
		<div class="right_side">
			<form class="search" method="POST">
				<br />ค้นหา : <input type="text" id="g_search" name="search" placeholder="กรอกชื่อ">
				<input type="button" value="ค้นหา" onclick="search_guest()">
			</form>
			<!-- For searcging list -->
			<div id="search_show">
				
			</div>

			<!-- for main Content -->
			<table class="guest_edit" border="1" padding="2px" style="margin-top:15px;">
				<?php
					$search = $_POST['search'];
					if(isset($search) && $search != "")
						$sql = "SELECT * FROM guest WHERE name = '$search' ORDER BY nation_ID limit 0, 30  ";
					else
						$sql = "SELECT * FROM guest ORDER BY nation_ID limit 0, 30  ";
					$result = mysql_query($sql) or die(mysql_error());
						echo "<tr class = \"m_user_table_header\">";
							echo "<td>Nation ID</td>";
							echo "<td>ชื่อ</td>";
							echo "<td>เบอร์โทรศีพท์</td>";
							echo "<td></td>";
						echo "</tr>";
					$i = 0;
					while($dbarr = mysql_fetch_array($result)) {
							$newGuest = new person($dbarr[0]);
							if($i%2==0)
								echo "<tr class=\"tr_odd\">";
							else
								echo "<tr class=\"tr_even\">";
								echo "<td>".$newGuest->get_nation_id()."</td>";
								echo "<td>".$newGuest->get_name()."</td>";
								echo "<td>".$newGuest->get_telNo()."</td>";
								echo "<td><b onclick=\"show_popup(".$newGuest->get_nation_id().")\">ดูเพิ่มเติม<b></td>";
							echo "</tr>";
							$i++;
						}
					?>
				</table>
		</div>
	</div>
</body>
</html>