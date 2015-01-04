<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$user_id   = 1;
$event_id  = 1; 


$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " user id:  " . $user_id;
echo " \n";
echo " event id:  " . $event_id;
echo " \n";
echo " ==================================================================== \n";
echo "test update  user events                                    \n";
echo " ==================================================================== \n ";
$res_key = "test_1";
//
echo " \n";

$role_id = 3;
//
echo " Role: " . $role_id; 
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["role_id"] = $role_id;  

$errArr = update_user_events($user_id, $event_id, $set_arr);
//
if ($errArr[ERR_AFFECTED_ROWS] == 1 ) {
	$result[$res_key]=$passed;
}
else {
	$role_id = 4;
	//
	echo " Role: " . $role_id;
	echo " \n";
	
	// set up set array
	$set_arr = array();
	$set_arr ["role_id"] = $role_id;
	
	$errArr = update_user_events($user_id, $event_id, $set_arr);
	if ($errArr[ERR_AFFECTED_ROWS] == 1 ) {
		$result[$res_key]=$passed;
	}
	else {
		$result[$res_key]=$failed;
	}
}
//
echo "\n";
print_r ($errArr);


echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


