<?php
	$id = $_POST['id'];
	include("en/_person_class.php");
	$newPerson = new person($id);
?>
<div class="Header_name">การจัดการข้อมูลส่วนตัว</div>
<form action="">
	<table border="0">
		<tr>
			<td>รหัสประจำตัวประชาชน</td>
			<td><input type="text" id="get_nation_id" value=<?php echo $newPerson->get_nation_id(); ?>></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type="text" id="get_username" value=<?php echo $newPerson->get_username(); ?>></td>
		</tr>
		<tr>
			<td>ชื่อ</td>
			<td><input type="text" id="get_name" value=<?php echo $newPerson->get_name(); ?>></td>
		</tr>
		<tr>
			<td>สกุล</td>
			<td><input type="text" id="get_surname" value=<?php echo $newPerson->get_surname(); ?>></td>
		</tr>
		<tr>
			<td>เบอร์โทรศัพท์</td>
			<td><input type="text" id="get_telNo" value=<?php echo $newPerson->get_telNo(); ?>></td>
		</tr>
		<tr>
			<td>เพศ</td>
			<td>
				<select id="get_Gender" >
					<option value="<?php echo $newPerson->get_Gender(); ?>"><?php echo $newPerson->get_Gender(); ?></option>
					<?php
						if($newPerson->get_Gender() == "ชาย") {
							echo "<option value=\"หญิง\">หญิง</option>";
						} else {
							echo "<option value=\"ชาย\">ชาย</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>สิทธ์การใช้งาน</td>
			<td>
				<select id="get_priv" >
					<?php
						echo"<option value=\"$newPerson->get_priv()\">".$newPerson->get_priv()."</option>";
						if($newPerson->get_priv() == "user") {
							echo "<option value=\"admin\">admin</option>";
						} else {
							echo "<option value=\"user\">user</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>E-mail</td>
			<td><input type="text" id="get_email" required value=<?php echo $newPerson->get_email(); ?>></td>
		</tr>
		<tr>
			<td id="update_msg"><input type="submit" onclick="update_personal();" name="submit" value="ยืนยันการแก้ไข" id="personal_data_edit"></td>
		</tr>
	</table>
</form>
