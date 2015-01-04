<?php

include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password
$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
echo " ==================================================================== \n ";
echo " Test Delete from frq_choice_descr \n";
echo " ==================================================================== \n";
$frq="DA";
echo "Delete frequency : " . $frq;
$errArr = delete_frq_choice_descr($frq); 
var_dump($errArr);
// Validation
list($errArr, $frq_choice_descr) = fetch_frq_choice_descr($frq, FETCH_ONE);
if (count($frq_choice_descr) == 0) {
	echo $passed;
	$result[]=$passed;
}
else {
	echo $failed; 
	$result[]=$failed;
}
echo "\n";

echo " ==================================================================== \n ";
echo " Test Insert  frq_choice_descr \n";
echo " ==================================================================== \n";
$frq="DA";
$frq_descr="Daily";
echo "Insert : " . $frq, " descr: "  . $frq_descr;
$errArr = insert_frq_choice_descr($frq, $frq_descr); 
var_dump($errArr);
// Validation
list($errArr, $frq_choice_descr) = fetch_frq_choice_descr($frq, FETCH_ONE);
if (count($frq_choice_descr) == 0) {
	echo $failed; 
	$result[]=$failed;
}
else {
	echo $passed;
	$result[]=$passed;
}
echo "\n";


echo " ==================================================================== \n";
echo "test selection 1 frq      \n";
echo " ==================================================================== \n";
$frq="DA";
echo "Select: " . $frq;

list($errArr, $frq_choice_descr) = fetch_frq_choice_descr($frq, FETCH_ONE);
print_r($frq_choice_descr);
print_r ($errArr);

// Validation
if (count($frq_choice_descr) == 0) {
	echo $failed; 
	$result[]=$failed;
}
else {
	echo $passed; 
	$result[]=$passed;
}
echo "\n";


echo " ==================================================================== \n";
echo "test selection all  frq      \n";
echo " ==================================================================== \n";
$frq="DA";
echo "Select: " . $frq;

list($errArr, $frq_choice_descr) = fetch_frq_choice_descr($frq, FETCH_ALL);
print_r($frq_choice_descr);
print_r ($errArr);


// Validation
if (count($frq_choice_descr) == 0) {
	echo $failed;
	$result[]=$failed; 
}
else {
	echo $passed; 
	$result[]=$passed;
}
echo "\n";
var_dump($result);

?>


