<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$addr_id  = 1;
$email = "lev.ostromich@gmail.com";

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " Address id: " . $addr_id;
echo " \n";
list ($errArr, $addresses) = fetch_address($addr_id);
$address = $addresses[0];
echo " ==================================================================== \n";
echo "test update                                                           \n";
echo " ==================================================================== \n ";
$res_key = "test_1";
//
echo " \n";
// Set up new D.O.B
$latitude = $address['latitude'] + 1;

echo " \n";
//
echo " New latitude: " . $latitude; 
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["latitude"] = $latitude; 

$errArr = update_address($addr_id, $set_arr);
//
echo "\n";
//
// It has to be no error
//
if ($errArr[ERR_AFFECTED_ROWS] == 1 ) {
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


