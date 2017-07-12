<?php
  /**
   * คลาส house เขียนโดยกฤษดา ดวงมาลา
   * เมื่อวันที่ 28 พฤษจิกายน 2558
   * ติดต่อ Kridsadacpe@gmail.com
   */
  class house
  {
      private $house_id;
      private $status;
      private $type;
      function __construct() {
          if(!isset($house_id)) {
            $sql = "SELECT house_id FROM house ORDER BY house_id DESC LIMIT 0,1";
            if($result = mysql_query($sql)) {
              $houseDB = mysql_fetch_array($result);
              $this->house_id = $houseDB[0]+1;
            }
          }
      }

      /*Setter*/
      function setHouseId($house_id)  {
        $this->house_id = $house_id;
        $status_get = "SELECT status, type FROM house WHERE house_Id = '$this->house_id'";
        if($result = mysql_query($status_get)) {
          $db = mysql_fetch_array($result);
          $this->status = $db[0];
          $this->type = $db[1];
        }
      }
      function enable_house()       {       
          $sql = "UPDATE house SET status = 'valid' WHERE house_id = '$this->house_id'";
          if(mysql_query($sql)) {
            return true;
          } else {
            return false;
          }
      }
      function disable_house()      { 
          $sql = "UPDATE house SET status = 'invalid' WHERE house_id = '$this->house_id'";
          if(mysql_query($sql)) {
            return true;
          } else {
            return false;
          }    
      }
      function setHouseType($type)  {       $this->type   = $type;      }

      /*Getter*/
      function getHouseID()         {       echo    $this->house_id;     }
      function getHouseStatus()     {       return $this->status;       }
      function getHouseType()       {       return $this->type;         }
      function enableAtDate($date) {
        $sql = "SELECT * FROM reserve WHERE house_Id = '$this->house_Id' AND c_in_date = '$date' ";
        if($result = mysql_query($sql)) {
          $nums = mysql_num_rows($result);
          if($nums != 0)
            return false;
          else
            return true;
        }
      }

      function update_house() {
        $sql = "UPDATE house SET status = '$this->status' AND type = '$this->type' WHERE house_id = '$this->house_id";
        if(mysql_query($sql))
          return true;
        else
          return false;
      }

      function changeType($type) {
        $sql = "UPDATE house SET type = '$type' WHERE house_id = '$this->house_id'";
        if(mysql_query($sql))
          return true;
        else
          return false;
      }
  }
?>
