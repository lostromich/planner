<?php
// Test user
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//
echo " \n";
echo " ==================================================================== \n";
echo " Test fetch all users                                                 \n";
echo " ==================================================================== \n";
$res_key="test_1";
echo " \n";
//
$email = "lev.ostromich@gmail.com";

echo " \n";
echo " \n";
list($errArr, $users) = fetch_users();

echo "\n";
if ( count($users) > 0 )  {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($users);
echo "\n";
print_r ($errArr);

echo " \n";
echo " \n";
echo " ==================================================================== \n";
echo " Test fetch one user                                                  \n";
echo " ==================================================================== \n";
$res_key="test_2";
echo " \n";
//
echo " e-mail address: " . $email;

echo " \n";
list($errArr, $users) = fetch_users($email);

echo "\n";
if ( count($users) > 0 )  {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($users);
echo "\n";
print_r ($errArr);

echo " \n";
echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);

?>


