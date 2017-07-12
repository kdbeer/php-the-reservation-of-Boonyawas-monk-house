<?php 
    session_start();
    include("app/en/connect.php");
?>
<?
if($_POST["Register"]=="regis")
{
	$username=$_POST["username"];
	$password=$_POST["password"];
	$r_assword = $_POST['r_password'];
  
  $name=$_POST["name"];
	$surname=$_POST["surname"];
  $Gender = $_POST['Gender'];

	$nation_ID=$_POST["nation_ID"];
	$Dob=$_POST["Dob"];
	$TelNo=$_POST["TelNo"];
	$email=$_POST["email"];

  $_check_exit = "SELECT * FROM person WHERE username = '$username'";
  $_get_check = mysql_query($_check_exit) or die(mysql_error());
  $num_row = mysql_num_rows($_get_check);

  if($num_row != 0) {
    echo "<script>document.getElementById(\"regis_report\").innerHTML = \"ขอโทษค่ะ username นี้ มีผู้ใช้แล้วค่ะ\"</script>";
  } else  if($password == $r_assword) {
    $sql1 = "INSERT INTO guest VALUES('$nation_ID', '$name', '$surname', '$Dob', '$TelNo')";
    $sql2 = "INSERT INTO person VALUES('$nation_ID', '$username', '$password', '$email', '$Gender', 'user')";
    if(mysql_query($sql1) && mysql_query($sql2)) {
      echo "<script>document.getElementById(\"show_content_id\").innerHTML = \"สมัครสมาชิกสำเร็จแล้ว\"</script>";
    }
  } else {
    echo "<script>document.getElementById(\"regis_report\").innerHTML = \"รหัสผ่านไม่ตรงกันค่ะ\"</script>";
  }

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="app/style/unregis_guest.css">
</head>
<body>
  <div class="unregis_wrapper">
      <span class="head_name">สมัครสมาชิก</span>
      <br><span id="regis_report" style="color:red"></span>
      <form name="form2" method="post" action="">
          <label for="nation_ID"><br>
          </label>
      </form>
      <form name="form5" method="post" action="">
        <table>
          <tr>
            <td><input type="text" name="username" placeholder="username" id="regis_username"/> </td>
          </tr>
          <tr>
            <td><input type="password" placeholder="password" name="password" id="regis_password"></td>
          </tr>

          <tr>
            <td><input type="password" placeholder="re - password" name="r_assword" id="regis_repassword" onchange="check_input_pass();"></td>
          </tr>

          <tr>
            <td><input type="text" placeholder="ชื่อ" name="name" id="regis_sname"></td>
          </tr>
          <tr>
            <td><input type="text" placeholder="นาทสกลุล" name="surname" id="regis_surname"></td>
          </tr>
          <tr>
            <td>เพศ :</td>
          </tr>
          <tr>
            <td>
              <select name="Gender" id="regis_gender" >
                <option value="ชาย">ชาย</option>
                <option value="หญิง">หญิง</option>
              </select>
            </td>
          </tr>
          <tr>
            <td><input type="text" placeholder="รหัสบัตรประชาชน" name="nation_ID" id="regis_nation_id"></td>
          </tr>
          <tr>
            <td>วันเกิด : </td>
          </tr>
          <tr>
            <td> <input type="date" placeholder="วันเกิด" name="Dob" id="regis_Dob" required /></td>
          </tr>
          <tr>
            <td><input type="text" placeholder="เบอร์โทรศัพท์" name="TelNo" id="regis_telno"></td>
          </tr>
          <tr>
            <td><input type="email" placeholder="E-mail" name="email" id="regis_email"></td>
          </tr>
        </table>
        <input type="button" name="Register" id=" Register" onclick="send_regis();" value="สมัครสมาชิก" />
      </form>
    </div>
</body>
</html>
