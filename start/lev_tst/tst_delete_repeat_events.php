<?php
// Test delete repeat events 
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$passed="passed";
$failed="failed";

/*
INSERT INTO  `repeat_events` (  `event_id` ,  `sdate_time` ,  `edate_time` )
VALUES (
99,  '2013-12-31 11:31:27',  '2013-12-31 13:12:17'
)

*/
$event_id=21;
$sdate_time = '2013-12-31 11:31:27';
$edate_time = '2013-12-31 12:12:17';
echo "Insert event_id: " . $event_id . " date time: " .$sdate_time . " " . $edate_time . " \n";;
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time);
print_r ($errArr);

$event_id=21;
$sdate_time = '2013-12-31 12:31:27';
$edate_time = '2013-12-31 13:12:17';
echo "Insert event_id: " . $event_id . " date time: " .$sdate_time . " " . $edate_time . " \n";;
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time);
print_r ($errArr);

$event_id=21;
$sdate_time = '2013-12-31 13:31:27';
$edate_time = '2013-12-31 15:12:17';
echo "Insert event_id: " . $event_id . " date time: " .$sdate_time . " " . $edate_time . " \n";;
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time);
print_r ($errArr);

echo " ==================================================================== \n";
echo "Test delete repeat_events - one event                                 \n";
echo " ==================================================================== \n";

$event_id=21;
$sdate_time = '2013-12-31 12:31:27';
$edate_time = '2013-12-31 13:12:17';
echo "Delete event_id: " . $event_id . " date time: " .$sdate_time . " " . $edate_time . " \n";

$errArr = delete_repeat_events($event_id, $sdate_time, DELETE_ONE); 
if ($errArr[ERR_AFFECTED_ROWS] == 1) {
	echo $passed . ": delete_repeat_events - one \n";
}
else {
	echo $failed  . ": delete_repeat_events - one \n";
}
print_r ($errArr);


echo " ==================================================================== \n";
echo "Test delete repeat_events - all ocurrances of the event               \n";
echo " ==================================================================== \n";

$event_id=21;
echo "Delete event_id: " . $event_id . " \n";

$errArr = delete_repeat_events($event_id);
if ($errArr[ERR_AFFECTED_ROWS] == 2) {
	echo $passed . ": delete_repeat_events -all \n";
}
else {
	echo $failed  . ": delete_repeat_events - all \n";
}
print_r ($errArr);
?>


