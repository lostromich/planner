<?php
// Test Password
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';

include_once 'tst_connect.inc.php';       // added password
// Test Update Password
//list($errArr, $hash) = update_password('johnSlee', 'planner1');
//list($errArr, $hash) = update_password('john', 'planner1');
//list($errArr, $hash) = update_password('john2', 'planner1');
//print_r($hash . "\n");
//print_r ($errArr);

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//
echo " \n";
echo " ==================================================================== \n";
echo "test set up password                                                  \n";
echo " ==================================================================== \n";
$res_key="set_and_check_pssw_1";
echo " \n";
//
$email = "lev.ostromich@gmail.com";
$pssw  = "planner1";

echo " Set up password for: " . $email . " password: " . $pssw;
echo " \n";
echo " \n";
list($errArr, $hash) = update_password($email, $pssw);

echo "\n";
if ( $errArr[ERR_AFFECTED_ROWS] == 1 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($hash);
print_r ($errArr);

echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test validate password                                                \n";
echo " ==================================================================== \n";
$res_key="set_and_check_pssw_2";
echo " \n";

$pssw_valid = validate_password($email, $pssw);

echo "\n";
if ( $pssw_valid ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

echo " hash: " . $hash ;
echo " \n";
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);

?>


