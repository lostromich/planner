<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
// 
//
echo " ==================================================================== \n";
echo "test fetch frends                                                     \n";
echo " ==================================================================== \n ";
$res_key="test_1";
$parent_event_id = 38;

echo " parent event id: " . $parent_event_id ; 
echo " \n";

$errArr = delete_events_by_parent_id($parent_event_id); 

//
echo "\n";
if ( $errArr [ERR_AFFECTED_ROWS] > 0 ) {
	$result[$res_key]=$passed;
}
else {
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