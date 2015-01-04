<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$event_id=1;

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " event id: " . $event_id ; 
echo " \n";

echo " ==================================================================== \n";
echo "test if it will fail with empty string                                \n";
echo " ==================================================================== \n ";
$res_key = "test_1";
//
echo " \n";

// set up set array  - empty array 
$set_arr = array();

$errArr = update_events($event_id, $set_arr);
//
echo "\n";
// It has to be error here
if ($errArr [ERR_CODE]) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);


echo " ==================================================================== \n";
echo "test with non-existed key-value                                      \n";
echo " ==================================================================== \n ";
$res_key = "test_2";
$non_existed_id     = 1234567; 
echo " non-exited id: " . $non_existed_id; 
echo " \n";
//
echo " \n";
$music   = "music";
//
echo " genre: " . $music ;
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["genre"] = $music;


$errArr = update_events($non_existed_id, $set_arr);
//
echo "\n";
// It has to be no record affected 
if ($errArr [ERR_AFFECTED_ROWS] == 0) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);



echo " ==================================================================== \n";
echo "test with non-existed key of set array (wrong column name)            \n";
echo " ==================================================================== \n ";
$res_key = "test_3";
$genre_1 = "genre_1";
echo " non-existed field name: " . $genre_1;
echo " \n";
//
echo " \n";
$music   = "music";
//
echo " genre: " . $music ;
echo " \n";

// set up set array
$set_arr = array();
$set_arr [$genre_1] = $music;


$errArr = update_events($event_id, $set_arr);
//
echo "\n";
//
// It has to be error
// 
if ($errArr [ERR_CODE]) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);

echo " ==================================================================== \n";
echo "test update genre                                                     \n";
echo " ==================================================================== \n ";
$res_key = "test_4";
$music   = "music";
$dance   = "dance";
//
echo " genre: " . $music ;
echo " \n";

// set up set array 
$set_arr = array();
$set_arr ["genre"] = $music;

$errArr = update_events($event_id, $set_arr);
//
echo "\n";
print_r ($errArr);
echo "\n";

if ($errArr [ERR_AFFECTED_ROWS] == 1) {
	$result[$res_key]=$passed;
}
else {
	$set_arr ["genre"] = $dance;
	$errArr = update_events($event_id, $set_arr);
	if ($errArr [ERR_AFFECTED_ROWS] == 1) {
		$result[$res_key]=$passed;
	}
	else {
	    $result[$res_key]=$failed;
	}    
}
echo "\n";

print_r ($errArr);

echo " ==================================================================== \n";
echo "test update genre and status                                          \n";
echo " ==================================================================== \n ";
$res_key = "test_5";
$bar     = "bar";

//
echo " genre: " . $bar ;
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["genre"] = $bar;
$set_arr ["event_status"] = STATUS_CANCEL;

$errArr = update_events($event_id, $set_arr);
//
echo "\n";
print_r ($errArr);
echo "\n";

if ($errArr [ERR_AFFECTED_ROWS] == 1) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($errArr);


echo " ==================================================================== \n";
echo "test update status to active                                         \n";
echo " ==================================================================== \n ";
$res_key = "test_5";
$bar     = "bar";

//
echo " genre: " . $bar ;
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["event_status"] = STATUS_ACTIVE; 

$errArr = update_events($event_id, $set_arr);
//
echo "\n";
print_r ($errArr);
echo "\n";

if ($errArr [ERR_AFFECTED_ROWS] == 1) {
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


