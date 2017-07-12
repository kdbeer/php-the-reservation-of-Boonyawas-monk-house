<?php 
    session_start();
    include("en/connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="app/style/manage_new_house.css">
   	<script src="js/jquery-2.1.4.min.js"></script>
      <script type="text/javascript">
         
         function changeThis(id) {
               $.ajax({
                type: 'POST',
                url: 'app/en/_edit_house.php',
                data: {
                     'mode'   : "change",
                     'house_id': id
               },
               success: function(data) {
                  $('#edit_house').html(data)
                }
            });
         }


         function del_this(id) {
               $.ajax({
                type: 'POST',
                url: 'app/en/_edit_house.php',
                data: {
                     'mode'   : "delete",
                     'house_id': id
               },
               success: function(data) {
                  $('#edit_house').html(data)
                }
            });
         }

         function changeType(id) {
               $.ajax({
                type: 'POST',
                url: 'app/en/_edit_house.php',
                data: {
                     'mode'   : "typeChange",
                     'house_id': id
               },
               success: function(data) {
                  $('#edit_house').html(data)
                }
            });
         }

         function enableThis(data) {
            alert(data);
         }

         function update_left() {
            $.ajax({
                type: 'POST',
                url: 'app/en/_edit_house.php',
                data: {
                  'mode'   : "update_left",
               },
               success: function(data) {
                  $('#add_new_house').html(data)
                }
            });
         }

         function addNew() {
            $.ajax({
                type: 'POST',
                url: 'app/en/_edit_house.php',
                data: {
                     'mode'         : "addNew",
                     'house_id'     : $('#h_id').val(),
                     'house_type'   : $('#h_type').val(),
                     'house_status' : $('#h_status').val()
               },
               success: function(data) {
                  $('#edit_house').html(data)
                  update_left();
                }
            });
         }
      </script>
</head>
<div class="wrapper_house_manage">
   <div class="header_edit">จัดการกุฏิ</div>
   <div class="add_new_house" id="add_new_house">
     	   <div>เพิ่มกุฏิ</div>
   	   <table class="add_new_house_table">
   	      <tr>
   	         <td>กุฏิที่</td>
   	            <?php
   	            	$query = "SELECT * FROM house ORDER BY house_Id DESC";
   			   		$_get_id = mysql_query($query) or die(mysql_error());
   			   		$h_id = mysql_fetch_array($_get_id);
   			   		$h_id = $h_id[0] + 1;
   	            ?>
   	         <td><?php echo "<input type=\"text\" id=\"h_id\" value=\"$h_id\" size=\"3\">"; ?></td>
   	      </tr>
   	      <tr>
   	         <td>สถานะ</td>
   	            <td><select name="status" id="h_status">
   	            	<option value="valid">valid</option>
   	            	<option value="invalid">invalid</option>
   	            </select>
   	         </td>
   	      </tr>
   	      <tr>
   	         <td>ประเภท</td>
   	         <td>
                  <select name="type" id="h_type">
      	            <option value="ชาย">ชาย</option>
      	            <option value="หญิง">หญิง</option>
      	         </select>
   	         </td>
   	      </tr>
   	      <tr>
   	         <td><input type="button" name="submit" value="เพิ่มกุฏินี้" onclick="addNew()" ></td>
   	      </tr>
   	   </table>
   </div>

   <div class="edit_house" id="edit_house">
      <table border="1">
         <?php
            $search = $_POST['search'];
            if(isset($search) && $search != "")
               $sql = "SELECT * FROM guest WHERE name = '$search' ORDER BY nation_ID limit 0, 30  ";
            else
               $sql = "SELECT H.house_Id, H.status, H.type FROM house AS H";

            $result = mysql_query($sql) or die(mysql_error());
            echo "<tr class=\"house_db_table\">";
               echo "<td class=\"name\">เลขที่</td>";
               echo "<td class=\"type\">ประเภท</td>";
               echo "<td >สถานะ</td>";
               echo "<td>ลบ</td>";
            echo "</tr>";
            $i = 0;
            while($dbarr = mysql_fetch_array($result)) {
                  echo "<tr>";
                        echo "<td>".$dbarr[0]."</td>";
                        
                        echo "<td>";
                           echo "<SELECT onchange=\"changeType(".$dbarr[0].")\">";
                              echo "<option value=\"$dbarr[2]\">".$dbarr[2]."</option>";
                              if($dbarr[2] == "ชาย")
                                 echo "<option value=\"หญิง\">หญิง</option>";
                              else
                                 echo "<option value=\"ชาย\">ชาย</option>";
                           echo "</SELECT>";
                        echo "</td>";


                        if($dbarr[1] == "valid" )
                           echo "<td style=\"width:100px;\"><a onclick=\"changeThis(".$dbarr[0].")\" class=\"on\" href=\"#\"></a></td>";
                        else
                          echo "<td style=\"width:100px;\"><a onclick=\"changeThis(".$dbarr[0].")\" class=\"off\" href=\"#\"></a></td>";
                        
                     echo "<td style=\"width:100px;\"><a onclick=\"del_this(".$dbarr[0].")\" class=\"cancel\" href=\"#\"></a></td>";
                     echo "</tr>";
               $i++;
            }
         ?>
      </table>
   </div>
</div>
</html>