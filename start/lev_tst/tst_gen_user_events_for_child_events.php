<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$parent_event_id=11;

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

//

echo " \n";
echo " Parent  event id: " . $parent_event_id;  
echo " \n";
echo " ==================================================================== \n";
echo "test generate user events for child events                            \n";
echo " ==================================================================== \n";
$res_key = "test_1";

$errArr = gen_user_events_for_child_events($parent_event_id);   
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


