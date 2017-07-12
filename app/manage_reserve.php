<?php 
    session_start();
    include("en/connect.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="app/style/manage_reserve.css">
</head>
   <div id="manage_reserve">
      <div class="manage_class">
         <div class="add_new_name">เพิ่มผู้จอง</div>
         <div class="add_new">
               <table>
                  <tr>
                     <td><input type="text" name="name" placeHolder="ชื่อผู้จอง"></td>
                  </tr>
                  <tr>
                     <td><input type="text" name="surname" placeHolder="นามสกุล" ></td>
                  </tr>
                  <tr>
                     <td><input type="text" name="surname" placeHolder="นามสกุล" ></td>
                  </tr>
                  <tr>
                     <td>วันที่จอง</td>
                  </tr>
                  <tr>
                     <?php 
                        $r_date = date("Y-m-d");   
                        echo "<input type=\"hidden\" name=\"r_date\" value=\"$r_date\">";
                     ?>
                     <td><?php echo $r_date;  ?></td>
                  </tr>
                  
                  <tr>
                     <td>วันที่เข้าพัก</td>
                  </tr>
                  <tr>
                     <td><input type="date" name="c_in_date" ></td>
                  </tr>
                  
                  <tr>
                     <td>หมายเลขห้อง</td>
                  </tr>
                  <tr>
                     <?php
                        $sql3 = "SELECT house_Id FROM house WHERE house_id NOT IN(SELECT house_id FROM reserve WHERE c_in_date = '$dbarr[4]')";
                        $_get_house = mysql_query($sql3) or die(mysql_error());
                        echo "<td><select name=\"house_id\">";
                           while ($houseDB = mysql_fetch_array($_get_house) ) {
                              echo "<option value=\"$houseDB[0]\">".$houseDB[0]."</option>";
                           }
                        echo "</select></td>";
                     ?>
                  </tr>
                  
                  <tr>
                     <td>วันที่ยกเลิกการพัก</td>
                  </tr>
                  <tr>
                     <td><input type="date" name="c_out_date" ></td>
                  </tr>

                  <tr>
                     <td>เวลาที่เข้าพัก</td>
                  </tr>
                  <tr>
                     <?php
                           $sql2 = "SELECT * FROM reserve WHERE r_id='$dbarr[0]'";
                           $result2 = mysql_query($sql2) or die(mysql_error());
                           $dbarr2 = mysql_fetch_array($result2);
                           echo "<td>";
                              echo "<select name=\"c_in_time\">";
                                 if ($dbarr2[6] == 0)
                                    echo "<option value=\"0\">เช้า</option>";
                                 else
                                    echo "<option value=\"1\">บ่าย</option>";
                                 
                                 if($dbarr2[5] == 0)
                                    echo "<option value=\"1\">บ่าย</option>";
                                 else
                                    echo "<option value=\"0\">เช้า</option>";
                              echo "</select>";
                           echo "</td>";
                     ?>
                  </tr>

                  <tr>
                     <td><input type="button" name="submit" value="เพิ่มผู้จอง"></td>
                  </tr>
               </table>
         </div>
      </div>


      <div class="manage_content">
         <div class="centent_name">ค้นหา</div>
         <div class="content_html">
            <div class="search_content">
               <input type="text"   placeholder="กรอกชื่อ">
               <input type="button" value="ค้นหา">
            </div>
         </div>

         <div class="centent_name">จัดการการจอง</div>
         <div class="content_html">
            <div class="content_show" id="content_show">
               <table>
                     <?php
                        $search = $_POST['search'];
                        if(isset($search) && $search != "")
                           $sql = "SELECT * FROM guest WHERE name = '$search' ORDER BY nation_ID limit 0, 30  ";
                        else
                           $sql = "SELECT R.r_id, R.personID, R.r_date, R.house_id, R.c_in_date, R.c_out_date, R.c_in_time FROM reserve AS R, person AS P WHERE personID = nation_ID";

                        $result = mysql_query($sql) or die(mysql_error());
                        echo "<tr>";
                           echo "<td>เลขที่</td>";
                           echo "<td>ผู้จอง</td>";
                           echo "<td>วันที่จอง</td>";
                           echo "<td>กุฏิ</td>";
                           echo "<td>เข้าพัก</td>";
                           echo "<td>ออกพัก</td>";
                           echo "<td>เวลา</td>";
                           echo "<td>Action</td>";
                        echo "</tr>";
                        while($dbarr = mysql_fetch_array($result)) {
                           echo "<form action=\"en/_edit_reserve.php\" method=\"POST\">";
                              echo "<tr>";
                                 $dates = $dbarr[2];
                                 $dates = date("Y-M-d", strtotime($dates));
                                 echo "<td>$dbarr[0]</td>";
                                 echo "<td><input type=\"text\" name=\"p_name\" value=\"$dbarr[1]\" ></td>";
                                 echo "<td><input type=\"text\" name=\"r_date\" value=\"$dates\" ></td>";

                                 $sql3 = "SELECT house_Id FROM house WHERE house_id NOT IN(SELECT house_id FROM reserve WHERE c_in_date = '$dbarr[4]')";
                                 $_get_house = mysql_query($sql3) or die(mysql_error());;
                                 echo "<td><select>";
                                    echo "<option value=\"$dbarr[3]\">".$dbarr[3]."</option>";
                                    while ($houseDB = mysql_fetch_array($_get_house) ) {
                                       echo "<option value=\"$houseDB[0]\">".$houseDB[0]."</option>";
                                    }
                                 echo "</select></td>";

                                 echo "<td><input type=\"date\" name=\"c_in_date\" value=\"$dbarr[4]\" size=\"11\"></td>";
                                 echo "<td><input type=\"date\" name=\"c_out_date\" value=\"$dbarr[5]\" size=\"11\"></td>";
                                 echo "<input type=\"hidden\" name=\"p_ID\" value=\"$dbarr[7]\">";

                                 $sql2 = "SELECT * FROM reserve WHERE r_id='$dbarr[0]'";
                                 $result2 = mysql_query($sql2) or die(mysql_error());
                                 $dbarr2 = mysql_fetch_array($result2);
                                 echo "<td>";
                                    echo "<select name=\"c_in_time\">";
                                       if ($dbarr2[6] == 0)
                                          echo "<option value=\"0\">เช้า</option>";
                                       else
                                          echo "<option value=\"1\">บ่าย</option>";
                                       
                                       if($dbarr2[6] == 0)
                                          echo "<option value=\"1\">บ่าย</option>";
                                       else
                                          echo "<option value=\"0\">เช้า</option>";

                                    echo "</select>";
                                 echo "</td>";
                                 echo "<td><input type=\"submit\" name=\"submit\" value=\"ลบ\" ><input type=\"submit\" name=\"submit\" value=\"เปลี่ยนแปลง\" ></td>";
                              echo "</tr>";
                           echo "</form>";

                        }
                     ?>
               </table>
            </div>
         </div>
      </div>
   </div>
</html>