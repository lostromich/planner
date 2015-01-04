<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " \n";
echo " ==================================================================== \n";
echo "test events table                                                     \n";
echo " ==================================================================== ";
$res_key = "test_1";
echo "\n Test key: " . $res_key . " \n";
$table_name = "events";

list($errArr, $events_columns) = show_columns($table_name);  
//
echo "\n";
if ( count($events_columns) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r( $events_columns);
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test users  table                                                     \n";
echo " ==================================================================== ";
$res_key = "test_2";
echo "\n Test key: " . $res_key . " \n";
$table_name = "users";

list($errArr, $events_columns) = show_columns($table_name);
//
echo "\n";
if ( count($events_columns) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r( $events_columns);
print_r ($errArr);

echo " \n";

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test non-existed   table                                               \n";
echo " ==================================================================== \n";
$res_key = "test_3";
echo "\n Test key: " . $res_key . " \n";
$table_name = "stam";

list($errArr, $events_columns) = show_columns($table_name);
//
echo "\n";
if ( count($events_columns) > 0 ) {
	$result[$res_key]=$failed;
}
else {
	$result[$res_key]=$passed; 
}
echo "\n";

print_r( $events_columns);
print_r ($errArr);

echo " \n";

echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


