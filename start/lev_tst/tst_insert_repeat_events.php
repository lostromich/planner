<?php
// Test insert repeat events
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password
$passed = "passed";
$failed = "failed";

/*
INSERT INTO  `repeat_events` (  `event_id` ,  `sdate_time` ,  `edate_time` )
VALUES (
99,  '2013-12-31 11:31:27',  '2013-12-31 13:12:17'
)

*/
$event_id=21;
echo "Delete event: " . $event_id . "\n";
$errArr = delete_repeat_events($event_id);

print_r ($errArr);

echo " ==================================================================== \n";
echo "Test insert  repeat events  \n";
echo " ==================================================================== \n";

$function_name = "insert_repeat_events";
$event_id=21;
$sdate_time='2013-12-31 11:31:27';
$edate_time='2013-12-31 13:31:27';

echo "Insert Event: " . $event_id . " " . $sdate_time ." " . $edate_time . "\n";
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time) ; 
if ($errArr[ERR_AFFECTED_ROWS] == 1) {
	echo $passed . ": " . $function_name ; 
}
else {
	echo $failed . ": " . $function_name ;
}
echo "\n";
print_r ($errArr);

?>


