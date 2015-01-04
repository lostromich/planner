<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$event_id=1;
$sdate_time= "2016-01-01 12:00:00";
$edate_time= "2016-01-02 13:00:00";


$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time;
echo " \n";
echo " ==================================================================== \n";
echo "test select all events                                           \n";
echo " ==================================================================== ";
$res_key = "test_1";

list($errArr, $events) = fetch_events();  
//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);

echo " ==================================================================== \n";
echo "test select all events for " . $event_id .           "\n";
echo " ==================================================================== \n ";
$res_key = "test_2";
list($errArr, $events) = fetch_events($event_id);
//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);

echo " ==================================================================== \n";
echo " test select all events (SELECT_ALL_EVENTS)  and start datetime, end date time      \n";
echo " ==================================================================== \n";
$res_key = "test_3";

echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time;
list($errArr, $events) = fetch_events(SELECT_ALL_EVENTS, $sdate_time, $edate_time,SELECT_DT_BOTH, PRIVACY_PUBLIC);
//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);


echo " ==================================================================== \n";
echo "test by event id and start datetime, end date time      \n";
echo " ==================================================================== \n";
$res_key = "test_4";

list($errArr, $events) = fetch_events($event_id, $sdate_time, $edate_time);
//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);



echo " ==================================================================== \n";
echo "test by event id and start datetime, end date time, by start date time       \n";
echo " ==================================================================== \n";
$res_key = "test_5";
$sdate_time= "2016-01-01 11:00:00";
$edate_time= "2016-01-01 12:00:00";
echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time;

list($errArr, $events) = fetch_events($event_id, $sdate_time, $edate_time, SELECT_DT_START);
//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);


echo " ==================================================================== \n";
echo "test by event id and start datetime, end date time, by end date time       \n";
echo " ==================================================================== \n";
$res_key = "test_6";
$sdate_time= "2016-01-01 11:00:00";
$edate_time= "2016-01-01 12:00:00";
echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time;

list($errArr, $events) = fetch_events($event_id, $sdate_time, $edate_time, SELECT_DT_END);
//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);


echo " ==================================================================== \n";
echo "test by event id and start datetime, end date time, select private     \n";
echo " ==================================================================== \n";
$res_key = "test_7";
$sdate_time= MIN_DATE_TIME; 
$edate_time= "2016-01-01 12:00:00";
echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time;

list($errArr, $events) = fetch_events($event_id, $sdate_time, $edate_time, SELECT_DT_END, PRIVACY_PRIVATE);

//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);



echo " ==================================================================== \n";
echo "test by event id and start datetime, end date time, select public      \n";
echo " ==================================================================== \n";
$res_key = "test_8";
$sdate_time= MIN_DATE_TIME;
$edate_time= "2016-01-01 12:00:00";
echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time;

list($errArr, $events) = fetch_events($event_id, $sdate_time, $edate_time, SELECT_DT_END, PRIVACY_PUBLIC);

//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);

echo " ==================================================================== \n";
echo "test by event id and start datetime, end date time, tag name         \n";
echo " ==================================================================== \n";
$res_key = "test_9";
$event_id=SELECT_ALL_EVENTS;
$sdate_time= MIN_DATE_TIME;
$edate_time= MAX_DATE_TIME; 
$tag_name="sleeping";
echo " event id: " . $event_id . " date time: " . $sdate_time . " " . $edate_time . " " . $tag_name;

list($errArr, $events) = fetch_events($event_id, $sdate_time, $edate_time, SELECT_DT_END, PRIVACY_PUBLIC, $tag_name);

//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($events);
print_r ($errArr);

echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


