<?php
include("connect.php");
class SimpleCalendar {

	/**
	 * Array of Week Day Names
	 *
	 * @var array
	 */
	public $wday_names = false;
	private $now;
	private $dailyHtml = array();
	private $offset = 0;
	private $reserveAble = true;
	/**
	 * Constructor - Calls the setDate function
	 *
	 * @see setDate
	 * @param null|string $date_string
	 */
	function __construct( $date_string = null ) {
		$this->setDate($date_string);
	}
	/**
	 * Sets the date for the calendar
	 *
	 * @param null|string $date_string Date string parsed by strtotime for the calendar date. If null set to current timestamp.
	 */
	public function setDate( $date_string = null ) {
		if( $date_string ) {
			$this->now = getdate(strtotime($date_string));
		} else {
			$this->now = getdate();
		}
	}
	/**
	 * Add a daily event to the calendar
	 *
	 * @param string      $html The raw HTML to place on the calendar for this event
	 * @param string      $start_date_string Date string for when the event starts
	 * @param null|string $end_date_string Date string for when the event ends. Defaults to start date
	 */
	public function addDailyHtml( $html, $start_date_string, $end_date_string = null ) {
		static $htmlCount = 0;
		$start_date = strtotime($start_date_string);
		if( $end_date_string ) {
			$end_date = strtotime($end_date_string);
		} else {
			$end_date = $start_date;
		}
		$working_date = $start_date;
		do {
			$tDate = getdate($working_date);
			$working_date += 86400;
			$this->dailyHtml[$tDate['year']][$tDate['mon']][$tDate['mday']][$htmlCount] = $html;
		} while( $working_date < $end_date + 1 );
		$htmlCount++;
	}
	/**
	 * Clear all daily events for the calendar
	 */
	public function clearDailyHtml() { $this->dailyHtml = array(); }
	/**
	 * Sets the first day of the week
	 *
	 * @param int|string $offset Day to start on, ex: "Monday" or 0-6 where 0 is Sunday
	 */
	public function setStartOfWeek( $offset ) {
		if( is_int($offset) ) {
			$this->offset = $offset % 7;
		} else {
			$this->offset = date('N', strtotime($offset)) % 7;
		}
	}
	/**
	 * Returns/Outputs the Calendar
	 *
	 * @param bool $echo Whether to echo resulting calendar
	 * @return string HTML of the Calendar
	 */
	public function show( $mode ) {

		$echo = true;
		if( $this->wday_names ) {
			$wdays = $this->wday_names;
		} else {
			$today = (86400 * (date("N")));
			$wdays = array();
			for( $i = 0; $i < 7; $i++ ) {
				$wdays[] = strftime('%a', time() - $today + ($i * 86400));
			}
		}
		$this->arrayRotate($wdays, $this->offset);
		$wday    = date('N', mktime(0, 0, 1, $this->now['mon'], 1, $this->now['year'])) - $this->offset;
		$no_days = cal_days_in_month(CAL_GREGORIAN, $this->now['mon'], $this->now['year']);
		$out = '<table cellpadding="0" cellspacing="0" class="SimpleCalendar"><thead><tr>';
		for( $i = 0; $i < 7; $i++ ) {
			if($i == 0)
				$out .= '<th class='.'"sunday"'.'>' . $wdays[$i] . '</th>';
			else
				$out .= '<th>' . $wdays[$i] . '</th>';
		}
		$out .= "</tr></thead>\n<tbody>\n<tr>";
		$wday = ($wday + 7) % 7;
		if( $wday == 7 ) {
			$wday = 0;
		} else {
			$out .= str_repeat('<td class="SCprefix">&nbsp;</td>', $wday);
		}
		$count = $wday + 1;
		
		for( $i = 1; $i <= $no_days; $i++ ) {
			
			//$today = date("Y-m-d", $datetime);
			//$out .= '<td' . ($i == $this->now['mday'] && $this->now['mon'] == date('n') && $this->now['year'] == $today ? ' class="today"' : '');
			
			$M = date("m");
			$Y = date("Y");
			$D = date("d");
			$today = $Y."-".$this->now['mon']."-".$i;
			
			/*###########################################*/
			/*###########################################*/
			/*###******  Validate user data  *********###*/
			/*###########################################*/


			$now = $Y."-".$M."-".$D;
			
			$sql = "SELECT * FROM reserve WHERE '$today'  BETWEEN c_in_date AND c_out_date";
			



			if($result = mysql_query($sql)) {
				$num = mysql_num_rows($result);
			}

			if($num != 0 && ($i < $D && $this->now['mon'] <= $M && $this->now['year'] <= $Y ))
				$out .= '<td' . ' class="past_reserve_date"';
			else if($i < $D && $this->now['mon'] < $M && $this->now['year'] < $Y )
				$out .= '<td' . ' class="past"';
			else if($i == $D && $M == $this->now['mon'])
				$out .= '<td' . ($now == $today ? ' class="today"' : '');
			else if($num != 0 && ($this->now['mon'] >= $M && $this->now['year'] >= $Y) )
				$out .= '<td' . ($num!=0 ? ' class="reserve_date"' : '');
			else
				$out .= '<td';
			
			/*###################################################*/
			/*###################Seting  function################*/
			/*###################################################*/

			if(($i < $D && $this->now['mon'] <= $M && $this->now['year'] <= $Y ) && $mode != "guest_view") {
				if($mode == "user_view_reserve")
					$out.=' onclick="'.'get_data('.$i.'); check();'.'" >';
				else
					$out.= '>';
			} else {
				if($mode == "user_house_reserve")
					$out.=' onclick="'.'user_house_reserve('.$i.'); check();'.'" >';
				if($mode == "user_view_reserve")
					$out.=' onclick="'.'get_data('.$i.'); check();'.'" >';
			}
			//get_data('.$i.')
			/*###################################################*/
			
			$out .= '<time datetime="' . date('Y-m-d', $datetime) . '">' . $i . '</time>';
				
			$out .= "</td>";
			if( $count > 6 ) {
				$out .= "</tr>\n" . ($i != $count ? '<tr>' : '');
				$count = 0;
			}
			$count++;
		}
		$out .= ($count != 1 ? str_repeat('<td class="SCsuffix">&nbsp;</td>', 8 - $count) : '') . "</tr>\n</tbody></table>\n";
		if( $echo ) {
			echo $out;
		}
		return $out;
	}

	private function arrayRotate( &$data, $steps ) {
		$count = count($data);
		if( $steps < 0 ) {
			$steps = $count + $steps;
		}
		$steps = $steps % $count;
		for( $i = 0; $i < $steps; $i++ ) {
			array_push($data, array_shift($data));
		}
	}
}