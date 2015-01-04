<?php

include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();


$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " \n";
echo " ==================================================================== \n";
echo " Test                                                                \n";
echo " ==================================================================== \n";
$test_n="test_1";
//
// Here is how to get enumeration values:
//
$table_name ="events";
$column_name="event_status";
echo " Table: " . $table_name . "  Column: " . $column_name;
echo " \n";

list($errArr, $enum_values) = get_enum_values($table_name, $column_name);  
print_r($enum_values);
print_r ($errArr);

if (count($enum_values) > 0 and $enum_values[0] <> NULL) {
	$result[$test_n] = $passed;
}
else {
	$result[$test_n] = $failed; 
}


echo " \n";
echo " ==================================================================== \n";
echo " Test                                                                \n";
echo " ==================================================================== \n";
$test_n="test_2";
//
// Here is how to get enumeration values:
//
$table_name ="events";
$column_name="genre";
echo " Table: " . $table_name . "  Column: " . $column_name;
echo " \n";

list($errArr, $enum_values) = get_enum_values($table_name, $column_name);
print_r($enum_values);
print_r ($errArr);

if (count($enum_values) > 0 and $enum_values[0] <> NULL) {
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


