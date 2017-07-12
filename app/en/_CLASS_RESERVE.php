<?php
  include_once("_CLASS_HOUSE.php");
  include_once("_person_class.php");
  echo "<meta charset=\"utf-8\">";
  /**
   *
   */
  class reserve
  {
    private $reserve_id;
    private $last_resere_id;
    private $persons;
    private $house;
    private $house_id;
    private $reserveDate;
    private $checkInDate;
    private $checkOutDate;
    private $CheckInTime;
    
    private $Valid_house;
    private $max_day;

    function __construct($personID, $check_in_date)
    {
        $this->persons = new person($personID);           //  สร้าง ออปเจค person
        $this->house = new house();                       //  สร้าง ออปเจค house
        $this->checkInDate = $check_in_date;              //  ใส่ เวลา การเช็กอิน
        $this->get_last_reserve();                        //  เลือกหมยเลขการจองครั้งล่าสุด
        $this->Valid_house = 0;
        $this->house_not_in_leagth();
    }

    /**
    *Class function
    */
    public static function make_reservation($personID, $r_id, $house_id, $c_in_date, $c_out_date, $c_in_time) {
      $today = date("Y-m-d");
      $sql = "INSERT INTO reserve VALUES('$personID', '$r_id', '$house_id', '$today', '$c_in_date', '$c_out_date', '$c_in_time', '1')";
      echo $indate;
      if(mysql_query($sql)) {
        return true;
      } else {
        return false;
      }
    }

    public static function get_new_reserve_id() {
      $sql = "SELECT * FROM reserve ORDER BY r_id DESC LIMIT 0,1";
      $id = 100;
      if($result = mysql_query($sql)) {
        $db = mysql_fetch_array($result) or die(mysql_error());
        $id = $db[1] + 1;
        return $id;

      }
    }

    public static function unreserve($r_id) {
      $sql = "DELETE FROM reserve WHERE r_id = '$r_id'";
      if(mysql_query($sql)) {
        return true;
      } else {
        return false;
      }
    }

    /**
    * Getter
    */
    function  get_person() {
      if(isset($this->persons)) {
        return $this->persons;
      } else {
        echo "Empty";
      }
    }
    function  get_last_reserve()  {
      $id = $this->persons->get_nation_id();
      $sql = "SELECT r_id FROM reserve WHERE personID = '$id' ORDER BY r_id DESC ";
      $result = mysql_query($sql) or die(mysql_error());
      if($dbarr = mysql_fetch_array($result)) {
        $this->last_resere_id = $dbarr[0];
      }
    }

    public function house_not_in_leagth() {
      $this->max_day = $this->checkInDate;      
      for($i=15;$i>0;$i--) {
        $Y  = date("Y", strtotime(date($this->max_day)));
        $m  = date("m", strtotime(date($this->max_day)));
        $d  = date("d", strtotime(date($this->max_day))) + 1;
        
        if($d>31 && $m==12) {   $Y+=1;  $d=1;$m=1;  }

        if($d > date("t", strtotime($this->max_day))) {
          $m++;
          $d = 1;
        }

        $this->max_day = $Y."-".$m."-".$d;
        $this->max_day = date("Y-m-d", strtotime($this->max_day));

        $get_house_avalible = 'SELECT house_id FROM `reserve` WHERE c_in_date NOT BETWEEN \'$this->checkInDate\' AND \'$this->max_day\' AND \'2015-1-1\' AND c_out_date NOT BETWEEN \'$this->checkInDate\' AND \'$this->max_day\'';
        if($result = mysql_query($get_house_avalible) or dir(mysql_error())) {
          if(mysql_num_rows($result) == 0) {
            break;
          }
          $temp = mysql_fetch_array($result); 
          $this->Valid_house = $temp[0];
        }
      }
      return $this->max_day;
    }
    private function draw_selection_day() {
        $d1 = date("d", strtotime(date($this->checkInDate)));
        $d2 = date("d", strtotime(date($this->max_day)));
        $m  = date("m");
        $Y  = date("Y");
        $loop = 15;
        if($d2 > $d1)
          $loop = $d2 - $d1;
        else {
          $loop = $d2 + (date("t", strtotime(date($this->checkInDate))) - $d1);
        }
      echo "<SELECT id=\"max_day\" class=\"show_time_class\">";
        $top = date("t", strtotime(date($this->checkInDate)));
        $st_day = date("d", strtotime(date($this->checkInDate))) + $i;
        $st_month = date("m", strtotime(date($this->checkInDate))) + $i;
        $st_year = date("Y", strtotime(date($this->checkInDate))) + $i;

        for ($i=0; $i < $loop; $i++) { 
            $st_date = $st_year."-".$st_month."-".$st_day;
            $st_date = date("Y-m-d", strtotime(date($st_date)));
            echo "<option value=\"$st_date\">";
              echo $st_date;
            echo "</option>";
            $st_day += 1; 
            if($st_day > $top) {
              $st_day = 1;
              $st_month += 1;
            }
            if($st_month > 12) {
              $st_month = 1;
              $st_year += 1;
            }
        }
      echo "</SELECT>";
    }

    function  get_reserveDate()       {   return $this->reserveDate;    }
    function  get_checkInDate()       {   return $this->checkInDate;    }
    function  get_checkOutDate()      {   return $this->checkOutDate;   }
    function  get_checkInTime()       {   return $this->CheckInTime;    }
    function  get_maxday()            {   return $this->max_day;        }
    function  get_house_id()          {   return $this->Valid_house;    }
    static function  date_today()     {   return date("Y-m-d");         }
    
    function renderForm() { ?>
      <div class="renderForm">
        <div class="date_txt">คุณต้องการจองการจองกฏิวันที่ : <?php echo $this->checkInDate; ?> กรุณากรอกข้อมูลด้านล่างให้ครับด้วยค่ะ</div>
        <form name="form1" action="">
          <div class="fillDate">เลือกวัน</div>
          <div >
            <?php
              $this->draw_selection_day();
            ?>
          </div>
          <div class="filltime">เลือกเวลา</div>
          <div >
              <select id="time_select" class="show_time_class">
                  <option value="0">ช่วงเช้า</option>
                  <option value="1">ช่วงบ่าย</option>
              </select>
          </div>
          <input type="button" id="submit"    value="ยืนยันการจอง" onclick="submit_form();">
          <input type="hidden" id="c_in_date" value="<?php echo $this->checkInDate; ?>">
          <input type="hidden" id="max_day"   value="<?php echo $this->max_day; ?>">
          <input type="hidden" id="personID"  value="<?php echo $this->persons->get_nation_id(); ?>">
          <input type="hidden" id="r_id"  value="<?php echo reserve::get_new_reserve_id(); ?>">
          <input type="hidden" id="house_id"  value="<?php echo $this->persons->get_house_id(); ?>"  >
        </form>
      </div>
    <?
    }

    /**
    * Setter
    */
    function  set_reserveDate($newDate)   {   $this->reserveDate = $newDate;    }
    function  set_checkInDate($newDate)   {   $this->checkInDate = $newDate;    }
    function  set_checkOutDate($newDate)  {   $this->checkOutDate = $newDate;   }
    function  set_checkInTime($newDate)   {   $this->CheckInTime = $newDate;    }
  }

 ?>
