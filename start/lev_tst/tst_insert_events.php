<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
// Test insert events
$eventName   ='party-4';
$location    = 'CN Tower';
$genre       = 'jumping';
$url         = 'www.google.com';
$sdate_time  = '2013-01-31 20:01:01';
$edate_time  = '2013-01-31 23:59:59';
$privacy     ='PB';
$event_descr = 'ins_events_1';
$event_status=STATUS_ACTIVE;
$addr_id     = 2;
$parent_event_id = NULL;

$res_key="ins_events_1";
$errArr = insert_events($eventName, $location, $genre, $url, $sdate_time, $edate_time, $privacy, 
		$event_descr, $event_status, $addr_id, $parent_event_id);

if ($errArr[ERR_AFFECTED_ROWS] == 1) {
	echo $passed;
	$result[$res_key]=$passed;
}
else {
	echo $failed;
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);
// --------------------------
$res_key="ins_events_2";
$eventName   ='party-5';
$event_descr = 'ins_events_2';
$privacy     ='PR';
$tag_1="sleeping";
$tag_2="sleeping2";
$tag_3="sleeping3";
$tag_4="sleeping4";
$tag_5="sleeping5";
$tag_6="sleeping6";


$errArr = insert_events($eventName, $location, $genre, $url, $sdate_time, $edate_time, $privacy,
		$event_descr, $event_status, $addr_id, $parent_event_id,
		$tag_1, $tag_2, $tag_3, $tag_4, $tag_5, $tag_6);

if ($errArr[ERR_AFFECTED_ROWS] == 1) {
	echo $passed;
	$result[$res_key]=$passed;
}
else {
	echo $failed;
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);


echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);

?>