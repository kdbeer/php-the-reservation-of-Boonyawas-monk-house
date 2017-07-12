<?php 
	include('Calendar.php');
	class call_calendar {
		private $mode = "";
		private $date_set = "";
		private $Calendar = null;
		
		public function __construct() {
	    	$this->Calendar = new SimpleCalendar();
		}

		public function getCalendar($mode, $month, $year) {
			$this->date_set = $month." ".$year;
			$this->Calendar->setDate($this->date_set);

				$this->Calendar->show($mode);
		}
	}

?>