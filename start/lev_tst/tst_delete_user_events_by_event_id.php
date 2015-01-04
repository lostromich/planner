<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

// Test delete user event by event id
$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//
echo " \n";
echo " ==================================================================== \n";
echo "test delet user event     by event id                                 \n";
echo " ==================================================================== \n";
$res_key="test_1";
$event_id=100;

echo "delete event id: " . $event_id;
echo " \n";

$errArr = delete_user_events_by_event_id($event_id) ;
//
echo "\n";
if ( $errArr[ERR_AFFECTED_ROWS] == 1 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);

echo " \n";
//
echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>