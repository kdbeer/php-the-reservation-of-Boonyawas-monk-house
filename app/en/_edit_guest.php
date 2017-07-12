<?php
	include("connect.php");
   include("_person_class.php");
   $mode = $_POST['mode'];

   if($mode == "add_new") {
      $id          = $_POST['id'];
      $username    = $_POST['username'];
      $password    = $_POST['password'];
      $name        = $_POST['name'];
      $surname     = $_POST['surname'];
      $dob         = $_POST['dob'];
      $telno       = $_POST['telno'];
      $email       = $_POST['email'];
      $Gender      = $_POST['Gender'];
      $priv        = $_POST['priv'];

      person::addNewPerson($id, $name, $surname, $dob, $telno, $username, $password,$email, $Gender, $priv);
   }

   if($mode == "update") {
      $id          = $_POST['id'];
      $newPerson   = new person($id);
      $username    = $_POST['username'];
      $name        = $_POST['name'];
      $surname     = $_POST['surname'];
      $dob         = $_POST['dob'];
      $telno       = $_POST['telno'];
      $email       = $_POST['email'];
      $Gender      = $_POST['Gender'];
      $priv        = $_POST['priv'];
      $mode        = $_POST['mode'];

      if($mode == "update") {
         $update_success = 1;
         if(!$newPerson->set_username($username))     $update_success = 0;
         if(!$newPerson->set_name($name))             $update_success = 0;
         if(!$newPerson->set_surname($surname))       $update_success = 0;
         if(!$newPerson->set_telNo($telno))           $update_success = 0;
         if(!$newPerson->set_email($email))           $update_success = 0;
         if(!$newPerson->set_Gender($Gender))         $update_success = 0;
         if(!$newPerson->set_priv($priv))             $update_success = 0;
         if(!$newPerson->update_table_person())       $update_success = 0;
         if(!$newPerson->update_table_guest())        $update_success = 0;

         
         if($update_success == 1)
            echo "<b style=\"color:green;\">การอัพเดทสำเร็จแล้วค่ะ<b>";
         else
            echo "<b style=\"color:green;\">อุปส์ มีบางอย่างเกิดขึ้น เราไม่สามารถอัพเดทข้อมูลได้<b>".$update_success;
      }
   }

   if($mode == "search") {
      $search_item = $_POST['telNo'];
      $sql = "SELECT * FROM guest WHERE telno = '$search_item'";
      $result  = mysql_query($sql) OR DIE(mysql_error());
      if(mysql_num_rows($result) != 0) {
         echo "<table>";
            echo "<tr class = \"m_user_table_header\">";
               echo "<td>ผลการค้นหา</td>";
               echo "<td></td>";
               echo "<td></td>";
               echo "<td></td>";
            echo "</tr>";

         $i = 1;
         while($dbarr = mysql_fetch_array($result)) {
            $newGuest = new person($dbarr[0]);
            echo "<tr class=\"search_result\">";
                  echo "<td>".$newGuest->get_nation_id()."</td>";
                  echo "<td>".$newGuest->get_name()."</td>";
                  echo "<td>".$newGuest->get_telNo()."</td>";
                  echo "<td><b onclick=\"show_popup(".$newGuest->get_nation_id().")\">ดูเพิ่มเติม<b></td>";
            echo "</tr>";
            $i++;
         }
         echo "</table>";
      } else {
         echo "<div id=\"search_error\">ไม่พบข้อมูลที่ท่านต้องการค้นหา</div>";
      }
   }
?>
</body>
</html>