<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

// Test Select user by username
$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//
echo " \n";
echo " ==================================================================== \n";
echo " Test insert one user                                                 \n";
echo " ==================================================================== \n";
$res_key="test_1";
echo " \n";
//
$firstName="lev2";
$lastName="ostromich2";
$email = "lev2.ostromich2@gmail.com";
$password = " "; 
$d_o_b  ="1999-12-31";
$gender = "Male"; 
$status = STATUS_ACTIVE;


echo " \n";
echo "User: " . $firstName . " " .  $lastName . " " .   $email . " " .  $password . " " .   $d_o_b .
         " " .   $gender  . " " .   $status;
echo " \n";
$errArr = insert_users($firstName, $lastName, $email, $password, $d_o_b, $gender,  $status);  

echo "\n";
if ( $errArr[ERR_AFFECTED_ROWS] == 1 )  {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";


echo "\n";
print_r ($errArr);

echo " \n";


echo " \n";
echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);




?>