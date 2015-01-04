<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$frq   = "DA"; 


$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " frq :  " . $frq;
echo " \n";
echo " ==================================================================== \n";
echo "test update  frq_choice descr                                         \n";
echo " ==================================================================== \n ";
$res_key = "test_1";
//
echo " \n";
// Set up new D.O.B
$descr = "Monthly"; 

echo " \n";
//
echo " Descr: " . $descr; 
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["frq_descr"] = $descr;  

$errArr = update_frq_choice_descr($frq, $set_arr);
//
if ($errArr[ERR_AFFECTED_ROWS] == 1 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
//
// set up[ back
//
$descr = "Daily";
$set_arr ["frq_descr"] = $descr;
$errArr = update_frq_choice_descr($frq, $set_arr);
//


echo "\n";
print_r ($errArr);


echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


