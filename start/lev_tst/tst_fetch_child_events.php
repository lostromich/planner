<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$parent_event_id=10;

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " Parent  event id: " . $parent_event_id;  
echo " \n";
echo " ==================================================================== \n";
echo "test select all child events                                          \n";
echo " ==================================================================== ";
$res_key = "test_1";

list($errArr, $events) = fetch_child_events($parent_event_id);  
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


