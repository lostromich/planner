<?php

include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";


echo " \n";
echo " ==================================================================== \n";
echo "test select all addresses                                           \n";
echo " ==================================================================== \n";


$res_key="fetch_address_1";
echo " fetch all addresses ";  
echo " \n";

list($errArr, $addresses) = fetch_address();  

echo "\n";
if (count($addresses > 0) ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($addresses);
print_r ($errArr);


echo " \n";
echo " ==================================================================== \n";
echo "test select one address                                      \n";
echo " ==================================================================== \n";

$addr_id =2;
$res_key="fetch_address_2";
echo " fetch address id: " . $addr_id;
echo " \n";

list($errArr, $addresses) = fetch_address($addr_id);

echo "\n";
if (count($addresses === 1) ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($addresses);
print_r ($errArr);
echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);

?>


