<?php

// Test select repeating events 
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password
//
// Insert 3 rows 
$function_name = "insert_repeat_events";
$event_id=22;
$sdate_time='2013-12-31 11:31:27';
$edate_time='2013-12-31 13:31:27';

echo "Insert Event: " . $event_id . " " . $sdate_time ." " . $edate_time . "\n";
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time) ;

$function_name = "insert_repeat_events";
$event_id=22;
$sdate_time='2013-12-31 15:31:27';
$edate_time='2013-12-31 16:31:27';

echo "Insert Event: " . $event_id . " " . $sdate_time ." " . $edate_time . "\n";
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time) ;


$function_name = "insert_repeat_events";
$event_id=23;
$sdate_time='2013-12-31 11:31:27';
$edate_time='2013-12-31 13:31:27';

echo "Insert Event: " . $event_id . " " . $sdate_time ." " . $edate_time . "\n";
$errArr = insert_repeat_events($event_id, $sdate_time, $edate_time) ;



echo " ==================================================================== \n ";
echo "test selection all repeating events \n";
echo " ==================================================================== \n";

$event_id =22;
echo "Event id: " . $event_id . "\n";
list($errArr, $repeat_events) = fetch_repeat_events($event_id); 
var_dump($repeat_events);
var_dump($errArr);


echo " ==================================================================== \n ";
echo "test selection all repeating events \n";
echo " ==================================================================== \n";

$event_id =23;
echo "Event id: " . $event_id . "\n";
list($errArr, $repeat_events) = fetch_repeat_events($event_id,MIN_DATE_TIME, FETCH_ALL);
var_dump($repeat_events);
var_dump($errArr);


echo " ==================================================================== \n ";
echo "test selection all repeating events \n";
echo " ==================================================================== \n";

$event_id =22;
echo "Event id: " . $event_id . "\n";
list($errArr, $repeat_events) = fetch_repeat_events($event_id,'2013-12-31 11:31:27', FETCH_ALL);
var_dump($repeat_events);
var_dump($errArr);


echo " ==================================================================== \n ";
echo "test selection ONE repeating events \n";
echo " ==================================================================== \n";

$event_id =22;
echo "Event id: " . $event_id . "\n";
list($errArr, $repeat_events) = fetch_repeat_events($event_id,'2013-12-31 11:31:27', FETCH_ONE);
var_dump($repeat_events);
var_dump($errArr);





?>
