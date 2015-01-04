<?php
include_once '../includes/constants.inc.php';

$sdate_time = "2013-12-15 11:01:03";
$edate_time = "2013-12-25 12:00:00";

echo "Start date: " . $sdate_time . " end time: " . $edate_time . "\n";

$start_time = new DateTime($sdate_time);
$end_time   = new DateTime($edate_time);
// Calculate difference in days between Start Date_time event and end Date_time event
$diff      = $start_time->diff($end_time);
$diff_days = $diff->d;

echo "Diff days: " .$diff_days  . "\n";

//

$curr_date_time=new DateTime($sdate_time);
$rpt_events_end_date_time=new DateTime($edate_time);

$start_h = $curr_date_time->format("H");
$start_m = $curr_date_time->format("i");
$start_s = $curr_date_time->format("s");

$min=23;
print("\n");
$curr_date_time->modify("+{$min} minute");
print_r ($curr_date_time);
print("\n");

$str_date_time = $curr_date_time->format("Y-m-d H:i:s");

print_r ("Date: " . $str_date_time);
print("\n");

// Set up correct start time...???
// http://stackoverflow.com/questions/676824/how-to-calculate-the-difference-between-two-dates-using-php
	
$frq  =FRQ_DAILY;	
	
while ($curr_date_time <= $rpt_events_end_date_time) {
	// Set up start and end time

	// Check if it is not equal to parent
    $curr_date_time->setTime($start_h, $start_m, $start_s); 
    
    // insert record
    print_r ($curr_date_time); 
	// set up next period date - change current date time
	switch ($frq) {
		case FRQ_DAILY:
			$curr_date_time->modify('+1 day');
			break;
		case FRQ_MONTHLY:
			$$curr_date_time->modify('+1 month');
			break;
		case FRQ_WEEKLY:
			$curr_date_time->modify('+1 week');
			break;
		default:
			return $errArr;
	}    // End Switch
}
?>