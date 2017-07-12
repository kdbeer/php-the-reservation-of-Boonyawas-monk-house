<?php
	include("connect.php");
	class person
	{
		private $nation_id;
		private $username;
		private $password;
		private $name;
		private $surname;
		private $email;
		private $Gender;
		private $priv;
		private $dob;
		private $telNo;

		private $reservAble = true;
		private $lastIn;

		public 	function __construct($person_ID) 	{ 	$this->nation_id = $person_ID; $this->fill_Gen_data(); $this->can_reserve();	}

		private function fill_Gen_data() {
			$sql = "SELECT * FROM person AS P, guest AS G WHERE P.nation_id = '$this->nation_id' AND G.nation_ID = '$this->nation_id'";
			$result = mysql_query($sql) or die(mysql_error());
			if($data_fetched = mysql_fetch_array($result)) {
				$this->username = $data_fetched[1];
				$this->password = $data_fetched[2];
				$this->email = $data_fetched[3];
				$this->Gender = $data_fetched[4];
				$this->priv = $data_fetched[5];
				$this->name = $data_fetched[7];
				$this->surname = $data_fetched[8];
				$this->dob = $data_fetched[9];
				$this->telNo = $data_fetched[10];
			} else {
				echo "Getting data Failed!!";
			}
		}

		public 	function can_reserve() {
			$reserv_ok = 1;
			$check_reserve = "SELECT DATE_FORMAT( c_out_date,  '%Y-%m-%d' ) FROM  `reserve` WHERE personID = '$this->nation_id' ORDER BY c_out_date DESC LIMIT 0 , 1";
			if($checked = mysql_query($check_reserve) ) {
				/*assign value last check in date*/
				if(mysql_num_rows($checked) == 0) {
					$this->reservAble = true;
					return $this->reservAble;
				}
				$dateDB = mysql_fetch_array($checked);
				$this->lastIn = date_create($dateDB[0]);
				$date = date_create($dateDB[0]);
				$this->lastIn = date_format($date, "Y-m-d");
				/*-------------------------------*/

				if(date("Y") < date_format($date, "Y"))
					$reserv_ok = 0;

				if(date("m") < date_format($date, "m"))
					$reserv_ok = 0;

				if((date("d") - date_format($date, "d")) <= 7 )
					$reserv_ok = 0;

				if($reserv_ok == 1)
					$this->reservAble = true;
				else
					$this->reservAble = false;

				return $this->reservAble;

			} else {
				echo "Cannot check data";
			}
		}

		public function update_table_person() {
			$update_person_sql = "UPDATE person SET username='$this->username', password='$this->password',";
			$update_person_sql .= "email='$this->email', Gender='$this->Gender', priv='$this->priv' WHERE nation_id='$this->nation_id'";
			if($update_result = mysql_query($update_person_sql))
				return true;
			else
				return false;
		}

		public function update_table_guest() {
			$update_guest_sql = "UPDATE guest SET name='$this->name', surname='$this->surname',";
			$update_guest_sql .= "telno='$this->telNo' WHERE nation_ID='$this->nation_id'";
			if($update_result = mysql_query($update_guest_sql))
				return true;
			else
				return false;
		}

		public function update_nation_id() {
			$update_person = "UPDATE person SET nation_id ='$this->nation_id'";
			$update_guest = "UPDATE person SET nation_ID='$this->nation_id'";
			if(mysql_query($update_person) AND mysql_query($update_guest))
				return true;
			else
				return false;
		}

		public function get_reserve_count() {
			$sql = "SELECT * FROM reserve WHERE personID = '$this->nation_id'";
			$result = mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($result);
		}

		public static function cal_range_date($date1, $date2) {
			$d1  = date("d", strtotime(date($date1)));
	        $d2  = date("d", strtotime(date($date2)));
	        $t  = date("t", strtotime(date($date1)));
	        if($d2 > $d1)
	        	return $d2 - $d1;
	        else
	        	return ($t - $d1) + $d2;
		}

		public function get_count_reserve() {
			$count = 0;
			$sql = "SELECT c_in_date, c_out_date FROM reserve WHERE personID = '$this->nation_id'";
			$result = mysql_query($sql) or die(mysql_error());
			while ($dbarr = mysql_fetch_array($result)) {
				$count += person::cal_range_date($dbarr[0], $dbarr[1]);
			}
			return $count;
		}

		public static function addNewPerson($nation_Id, $name, $surname, $new_dob, $new_telNo, $username, $password, $email, $Gender, $priv) {
			$nationId = 0;
			$nationId = $nation_Id;
			if($nationId != 0) {
				$insert_to_guest 	= "INSERT INTO guest VALUES('$nationId', '$name', '$surname', '$new_dob', '$new_telNo')";
				$insert_to_person  	= "INSERT INTO person VALUES('$nationId', '$username', '$password', '$email', '$Gender', '$priv')";
				if(mysql_query($insert_to_person) && mysql_query($insert_to_guest)) {
					echo "บันทึกข้อมูลเสร็จสิ้น";
				}
			} else {
				echo "ไม่สามารถจัดการข้อมูลได้";
			}
		}

		/*-------------------------------*/
		/**Function that usualy use can get it from here
		*/
		public function get_nation_id() 	{	return $this->nation_id; 		}
		public function get_username() 		{  	return $this->username;  		}
		public function get_password() 		{  	return $this->password;  		}
		public function get_name() 			{  	return $this->name; 			}
		public function get_surname() 		{ 	return $this->surname; 			}
		public function get_email() 		{ 	return $this->email; 			}
		public function get_Gender() 		{ 	return $this->Gender; 			}
		public function get_priv() 			{ 	return $this->priv; 			}
		public function get_dob() 			{ 	return $this->dob; 				}
		public function get_telNo() 		{	return $this->telNo;			}
		public function get_lastIn() 		{	return $this->lastIn;			}
		public function get_reserveable() 	{	return $this->reservAble;		}

		/*-------------------------------*/
		/**Function that usualy use can get it from here
				SET FUNCTION!!
		*/
		public function set_nation_id($nation_id_in){	$this->nation_id = $nation_id;	}
		public function set_username($username) 		{	if($this->username = $username)		return true;	}
		public function set_password($password) 		{	if($this->password = $password)		return true; 	}
		public function set_name($name) 				{	if($this->name = $name)				return true;   	}
		public function set_surname($surname) 			{	if($this->surname = $surname)		return true;	}
		public function set_email($email) 				{	if($this->email = $email)			return true;	}
		public function set_Gender($Gender) 			{	if($this->Gender = $Gender)			return true;	}
		public function set_priv($priv) 				{	if($this->priv = $priv)				return true;	}
		public function set_dob($dob) 					{	if($this->dob = $dob)				return true;	}
		public function set_telNo($telNo) 				{	if($this->telNo = $telNo)			return true;	}

	}
?>
