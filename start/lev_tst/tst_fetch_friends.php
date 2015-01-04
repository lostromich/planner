<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " ==================================================================== \n";
echo "test fetch frends                                                     \n";
echo " ==================================================================== \n ";
$email="lev.ostromich@gmail.com";

$res_key="test_1";
echo " email: " . $email; 
echo " \n";

list($errArr, $friends) = fetch_friends($email);   

//
echo "\n";
if ( count($friends) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r ($friends);
echo " \n";
print_r ($errArr);

echo " \n";
//
echo " \n";
echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>


