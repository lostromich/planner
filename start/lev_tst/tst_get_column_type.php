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
echo "test get column type                                                 \n";
echo " ==================================================================== ";
$res_key = "test_1";
echo "\n Test key: " . $res_key . " \n";
$table_name  = "events";
$column_name = "eventName";

echo "\n table name: " . $table_name . " column: " . $column_name;
$column_type_row = get_column_type($table_name, $column_name); 
 
//
echo "\n";
if ( $column_type_row != NULL ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r( $column_type_row);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test get column type - not existed  column                            \n";
echo " ==================================================================== \n";
$res_key = "test_2";
echo "\n Test key: " . $res_key . " \n";
$table_name  = "events";
$column_name = "email_1";

echo "\n table name: " . $table_name . " column: " . $column_name;
$column_type_row = get_column_type($table_name, $column_name);

//
echo "\n";
if ( $column_type_row != NULL ) {
	$result[$res_key]=$failed;
}
else {
	$result[$res_key]=$passed;
}
echo "\n";

print_r( $column_type_row);

echo " \n";
echo " \n";

echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


