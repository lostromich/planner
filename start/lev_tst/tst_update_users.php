<?php

include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$user_id  = 5;
$email = "lev.ostromich@gmail.com";

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";

echo " user id: " . $user_id ; 
echo " \n";
// Get the user's birthday 
list($errArr, $users) = fetch_users($email);
$user = $users[0];
$d_o_b   = $user['d_o_b'];
echo " ==================================================================== \n";
echo "test if it will fail with empty string                                \n";
echo " ==================================================================== \n ";
$res_key = "test_1";
//
echo " \n";

// set up set array  - empty array 
$set_arr = array();

$errArr = update_users($user_id, $set_arr);
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
echo " non-existed id: " . $non_existed_id; 
// Set up new D.O.B
$date_dob = new DateTime($d_o_b);
$date_dob->modify("+1 day");
$d_o_b   = $date_dob->format(DFT_DATE_FORMAT); 
echo " \n";
//
echo " \n";
//
echo " D.O.B: " . $d_o_b; 
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["d_o_b"] = $d_o_b;

$errArr = update_users($non_existed_id,  $set_arr);
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
$stam_1  = "stam_1";
echo " non-existed field name: " . $stam_1;
echo " \n";
//
echo " \n";
// Set up new D.O.B
$date_dob = new DateTime($d_o_b);
$date_dob->modify("+1 day");
$d_o_b   = $date_dob->format(DFT_DATE_FORMAT);
echo " \n";

//
echo " D.O.B: " . $d_o_b;
echo " \n";

// set up set array
$set_arr = array();
$set_arr [$stam_1] = $d_o_b;

$errArr = update_users($user_id, $set_arr);
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
echo "test update d_o__b                                                   \n";
echo " ==================================================================== \n ";
$res_key = "test_4";

//
echo " \n";
// Set up new D.O.B
$date_dob = new DateTime($d_o_b);
$date_dob->modify("+1 day");
$d_o_b   = $date_dob->format(DFT_DATE_FORMAT);
echo " \n";
//
echo " D.O.B: " . $d_o_b;
echo " \n";

// set up set array
$set_arr = array();
$set_arr ["d_o_b"] = $d_o_b;

$errArr = update_users($user_id, $set_arr);
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

echo " ==================================================================== \n";
echo "test update all status to Active                                  \n";
echo " ==================================================================== \n ";
$res_key = "test_5";
// Set up new D.O.B

// set up set array
$set_arr = array();
$set_arr ["status"] = STATUS_INACTIVE; 

$var_null = NULL;
$errArr = update_users($var_null, $set_arr);
//
echo "\n";
//
// It has to be no error
//
if ($errArr[ERR_AFFECTED_ROWS] > 0  ) {
	$tmp_passed_1 = TRUE;
}
else {
	$tmp_passed_1 = FALSE;
}
//
// Back to active
//
$set_arr ["status"] = STATUS_ACTIVE;

$var_null = NULL;
$errArr = update_users($var_null, $set_arr);
//
echo "\n";
//
// It has to be no error
//
if ($errArr[ERR_AFFECTED_ROWS] > 0  ) {
	$tmp_passed_2 = TRUE;
}
else {
	$tmp_passed_2 = FALSE;
}
//
if ($tmp_passed_1 or $tmp_passed_2) {
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


