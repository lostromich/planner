<?php
// Test generate repeating events
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//

echo " ==================================================================== \n";
echo " Generate repeating events in repeat_events table - RPT_EVENT_TYPE_SEPARATE \n";
echo " ==================================================================== \n";
// Delete repeat events participating in the test
delete_repeat_events(7);
delete_repeat_events(8);
delete_repeat_events(9);

echo " ==================================================================== \n";
echo " Test repeat events generation - Daily                                \n";
echo " ==================================================================== \n";
$res_key="test_1";

$rpt_events_start = "2013-12-16 11:01:03";
$rpt_events_end   = "2013-12-25 12:00:00";
echo "Start date: " . $rpt_events_start . " end time: " . $rpt_events_end . "\n";

$frq = FRQ_DAILY;
$event_id=7;
echo "Frequency: " . $frq . " event id: ".  $event_id;
echo "\n";

$errArr  = gen_events($event_id, $frq, $rpt_events_start, $rpt_events_end, RPT_EVENT_TYPE_SEPARATE);  
print_r ($errArr);

// test
list($errArr, $events) = fetch_repeat_events($event_id);
echo "\n";
print_r ($events);
echo "\n";

if (count($events) == 10) {
	$result[$res_key] = $passed;
}
else {
	$result[$res_key] = $failed;
}

echo " ==================================================================== \n";
echo " Test repeat events generation - Weekly                                \n";
echo " ==================================================================== \n";
$res_key="test_2";

$rpt_events_start = "2013-12-15 11:01:03";
$rpt_events_end = "2013-12-31 12:00:00";
echo "Start date: " . $rpt_events_start . " end time: " . $rpt_events_end . "\n";

$frq = FRQ_WEEKLY;
$event_id=8;
echo "Frequency: " . $frq . " event id: ".  $event_id;
echo "\n";

$errArr  = gen_events($event_id, $frq, $rpt_events_start, $rpt_events_end, RPT_EVENT_TYPE_SEPARATE);

// test
list($errArr, $events)  = fetch_repeat_events($event_id);
echo "\n";

print_r ($events);
echo "\n";

if (count($events) === 3) {
	$result[$res_key] = $passed;
}
else {
	$result[$res_key] = $failed;
}

print_r ($errArr);



echo " ==================================================================== \n";
echo " Test repeat events generation - Monthly                              \n";
echo " ==================================================================== \n";
$res_key="test_3";

$rpt_events_start = "2013-12-16 11:01:03";
$rpt_events_end = "2014-12-25 12:00:00";
echo "Start date: " . $rpt_events_start . " end time: " . $rpt_events_end . "\n";

$frq = FRQ_MONTHLY;
$event_id=9;
echo "Frequency: " . $frq . " event id: ".  $event_id;
echo "\n";

$errArr  = gen_events($event_id, $frq, $rpt_events_start, $rpt_events_end, RPT_EVENT_TYPE_SEPARATE);

// test if rows was inserted
list($errArr, $events)  = fetch_repeat_events($event_id);
echo "\n";
print_r ($events);
echo "\n";

if (count($events) === 13) {
	$result[$res_key] = $passed;
}
else {
	$result[$res_key] = $failed;
}

print_r ($errArr);


echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);



?>


