<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " ==================================================================== \n";
echo "test fetch user events by user id                                     \n";
echo " ==================================================================== \n ";
$user_id=5;
$res_key="test_1";
echo " user id: " . $user_id;
echo " \n";

list($errArr, $events) = fetch_user_events($user_id);  

//
echo "\n";
if ( count($events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($events);
echo " \n";
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


