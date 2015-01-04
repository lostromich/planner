<?php

include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " ==================================================================== \n";
echo " Test delete address                                                 \n";
echo " ==================================================================== ";
$test_n="test_1";
$addr_id=1;
echo "\n adddress id: " . $addr_id;
echo " \n";

$errArr = delete_address($addr_id);   
print_r ($errArr);
// Check if delete is Ok
if ($errArr[ERR_AFFECTED_ROWS] == 1) {
	$result[$test_n] = $passed;
}
else {
	$result[$test_n] = $failed; 
}

echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


