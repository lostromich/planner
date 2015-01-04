<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

// Test delete event from the provided user
$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//
echo " \n";
echo " ==================================================================== \n";
echo "test delet user event                                              \n";
echo " ==================================================================== \n";
$res_key="test_1";
$user_id=99;
$event_id=100;

echo "delete user id: " . $user_id . "  event id: " . $event_id;
echo " \n";

$errArr = delete_user_events_by_user_event_id($user_id, $event_id) ;
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