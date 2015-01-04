<?php

include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
echo " ==================================================================== \n ";
echo " Test Delete from repeat_events_frq_choice \n";
echo " ==================================================================== \n";
$event_id=1;
$frq="DA";
$sdate_time= "2013-01-01 12:00:00";
$edate_time= "2013-01-01 13:00:00";


echo "Delete event id : " . $event_id; 
$errArr = delete_repeat_events_frq_choice($event_id);   
var_dump($errArr);
// Validation
list($errArr, $repeat_events_frq_choice) = fetch_repeat_events_frq_choice($event_id); 
if (count($repeat_events_frq_choice) == 0) {
	echo $passed;
	$result[]=$passed;
}
else {
	echo $failed; 
	$result[]=$failed;
}
echo "\n";

echo " ==================================================================== \n ";
echo " Test Insert  repeat_events_frq_choice                                \n";
echo " ==================================================================== \n";
$event_id=1;
$frq="DA";
$sdate_time= "2013-01-01 12:00:00";
$edate_time= "2013-01-01 13:00:00";

echo "Insert : " . $event_id . " " . $frq . " Date: " . $sdate_time . " " . $edate_time; 
$errArr = insert_repeat_events_frq_choice($event_id, $frq, $sdate_time, $edate_time); 
var_dump($errArr);
// Validation
list($errArr, $repeat_events_frq_choice) = fetch_repeat_events_frq_choice($event_id); 
if (count($repeat_events_frq_choice) == 	0) {
	echo $failed; 
	$result[]=$failed;
}
else {
	echo $passed;
	$result[]=$passed;
}
echo "\n";


echo " ==================================================================== \n";
echo "test selection 1 frq      \n";
echo " ==================================================================== \n";
$event_id=1;
$frq="DA";
$sdate_time= "2013-01-01 12:00:00";
$edate_time= "2013-01-01 13:00:00";

list($errArr, $repeat_events_frq_choice) = fetch_repeat_events_frq_choice($event_id); 
print_r($repeat_events_frq_choice);
print_r ($errArr);

// Validation
if (count($repeat_events_frq_choice) == 0) {
	echo $failed; 
	$result[]=$failed;
}
else {
	echo $passed; 
	$result[]=$passed;
}
echo "\n";

var_dump($result);
?>


