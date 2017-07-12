<?php
	echo "<meta charset=\"utf-8\">";
	include("_CLASS_HOUSE.php");
	include("connect.php");
	
	$mode = $_POST['mode'];
	$id = $_POST['house_id'];

	if($mode == "change") {
		$newHouse = new house();
		$newHouse->setHouseId($id);
		if ($newHouse->getHouseStatus() == "invalid")
			$newHouse->enable_house();
		else
			$newHouse->disable_house();
		draw_house();
	}

	if($mode == "typeChange") {
		$newHouse = new house();
		$newHouse->setHouseId($id);
		if ($newHouse->getHouseType() == "ชาย")
			$newHouse->changeType("หญิง");
		else
			$newHouse->changeType("ชาย");
		
		draw_house();
	}

	if($mode == "delete") {
		$sql = "DELETE FROM house WHERE house_id = '$id'";
		$sql_del = "DELETE FROM reserve WHERE house_id = '$id'";
		if(mysql_query($sql) && mysql_query($sql_del)) {
			draw_house();
		} else {
			echo "ไม่สามารถลบกุฏิหลังนี้ได้ค่ะ";
		}
	}
		function draw_house() { ?>
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
	<?php 	}	

	if($mode == "addNew") {
		$status = $_POST['house_status'];
		$type = $_POST['house_type'];
		$h_id = $_POST['house_id'];
		$check = "SELECT * FROM house WHERE house_id = '$h_id'";
        $result = mysql_query($check);
        if(mysql_num_rows($result) != 0) {
        	echo "ขออถัยค่ะ มีห้องหมายเลขนี้แล้ว";
        } else {
        	$insert = "INSERT INTO house VALUES('$h_id', '$status', '$type', '1')";
          	if(mysql_query($insert))
          		draw_house();
          	else
          		echo "ขออภัยค่ะ ไม่สามารถเพิ่มตารางได้";
		}
	}

	if($mode == "update_left") { ?>
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
	<?php }

	
?>