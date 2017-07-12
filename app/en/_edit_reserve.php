<?php
   session_start();
   include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>_edit_guest : Reserve system of Monk's house</title>
</head>
<body>

<?php
    if(($_SESSION["personID"] == "" or $_SESSION["personID"] == "unknow" ) AND$_SESSION["group"] == "admin")  {
            echo "<script>alert(\"กรุณาเข้าสู่ระบบก่อน\")</script>";
            echo "redirecting";
            echo "<script>window.location = '../../app/login.php'</script>";
      }

      $submit = $_POST['submit'];
      $c_date = DATE("Y-m-d");
      $admin = $_SESSION["personID"];

      if($_POST['submit'] == "ลบ" || $_POST['submit'] == "เปลี่ยนแปลง") {
         $r_id = $_POST['r_id'];
         $get_person = "SELECT personID FROM reserve WHERE r_id = '$r_id'";
         $_get_person = mysql_query($get_person) or die(mysql_error());
         $_get_person = mysql_fetch_array($_get_person ) or die(mysql_error());
         $_person = $_get_person[0];
      }


      if($submit == "ลบ") {
         $sql = "DELETE FROM reserve WHERE r_id = '$r_id'";
         $sql2 = "SELECT * FROM reserve";

         $update_massage = "INSERT INTO massage VALUES('','1', '0', '$_person', '$admin', '$c_date')";
         mysql_query($update_massage) or die(mysql_error());

      } else {
         $p_ID = $_POST['p_ID'];
         $name = $_POST['p_name'];
         $r_date = $_POST['r_date'];
         $house_id = $_POST['house_id'];
         $c_in_date = $_POST['c_in_date'];
         $c_out_date = $_POST['c_out_date'];
         $c_in_time = $_POST['c_in_time'];

         if($submit == "เปลี่ยนแปลง") {
            $sql = "UPDATE guest SET name = '$name' WHERE nation_ID = '$p_ID'";
            $sql2 = "UPDATE reserve SET  house_id='$house_id' , r_date='$r_date', c_in_date='$c_in_date', c_out_date = '$c_out_date', c_in_time = '$c_in_time'  WHERE r_id='$r_id'";

            $update_massage = "INSERT INTO massage VALUES('' ,'1', '0', '$_person', '$admin', '$c_date')";
            mysql_query($update_massage) or die(mysql_error());
         } 
         if ($submit == "เพิ่มผู้จอง") {
           $_today = $_POST['c_in_date'];
           $check_date_sql = "SELECT * FROM system WHERE job_date = '$_today'";
           $check_date = mysql_query($check_date_sql) or die(mysql_error());
           if(mysql_num_rows($check_date) != 0) {
               echo "<script>alert(\"ไม่อนุญาติให้จองในสันที่ ".$_today." ค่ะ\")</script>";
               echo "redirecting";
               echo "<script>window.location = '../../app/manage_reserve.php'</script>";
           }

            $sql = "SELECT r_id FROM reserve ORDER BY r_id DESC LIMIT 0, 1";
            $r_id = mysql_query($sql) or die(mysql_error());
            $g_name = $_POST['name'];
            $g_username = $_POST['surname'];

            
            $_get_guest_sql = "SELECT nation_ID FROM guest WHERE name = '$g_name' AND surname = '$g_username'";     
            $_get_guest = mysql_query($_get_guest_sql) or die(mysql_error());
            if(mysql_num_rows($_get_guest) == 0) {
               echo "<script>alert(\"ไม่พบผู้ใช้คนดังกล่าว\")</script>";
               echo "redirecting";
               echo "<script>window.location = '../../app/manage_reserve.php'</script>";
            }
            $_get_guest = mysql_fetch_array($_get_guest ) or die(mysql_error());
            $_get_guest = $_get_guest[0];
            echo $_get_guest;

            if(mysql_num_rows($r_id) != 0) {
               $_get_rid = mysql_fetch_array($r_id) or die(mysql_error());
               $r_id = $_get_rid[0] + 1;
            } else {
               $r_id = 1;
            }
            $sql2 = "INSERT INTO reserve VALUES('$_get_guest', '$r_id', '$house_id', '$r_date', '$c_in_date', '$c_out_date', '$c_in_time', '1')";

            $update_massage = "INSERT INTO massage VALUES('' ,'3', '0', '$_get_guest', '$admin', '$c_date')";
            mysql_query($update_massage) or die(mysql_error());

         }
      }
      echo "Redirecting";

      if($result = mysql_query($sql) && $result2 = mysql_query($sql2)) {
            echo "<script>alert(\"กำเนินการเสร็จแล้ว\")</script>";
            echo "redirecting";
            echo "<script>window.location = '../../app/manage_reserve.php'</script>";
      } else {
            echo "<script>alert(\"การจัดการข้อมูลล้มเหลว กรุณาลองใหม่อีกครั้งค่ะ\")</script>";
            echo "redirecting";
            echo "<script>window.location = '../../app/manage_reserve.php'</script>";
      }

?>
</body>
</html>