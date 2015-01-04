<?php
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
// Test insert address

echo " ==================================================================== \n";
echo " Test insert address                                                 \n";
echo " ==================================================================== \n ";

$res_key="ins_address_1";
// Set up inserted values
$street_no=77;
$street_name ="roxborough lane";
$street_direct_code=" ";
$city="thornhill";
$postal_code="l4j4t5";
$country_code="Canada"; 
$province_code="ON";
$misc_addr_line=" ";
$addr_tel_no="905 763 6235";
$addr_email="lev.ostromich@gmail.com"; 
$latitude=43.8119515;
$longitude=-79.4458882;
//
echo "Insert the record: " . $street_no . " " . $street_name . " " . $street_direct_code
. " " . $city . " " . $postal_code . " " . $country_code . " "
		. $province_code . " " .  $misc_addr_line . "tel: " .  $addr_tel_no . " " . $addr_email
		. " position: " . $latitude . " " . $longitude;
//
$errArr=insert_address($street_no, $street_name, $street_direct_code, $city, $postal_code, $country_code,
		$province_code, $misc_addr_line, $addr_tel_no, $addr_email,
		$latitude, $longitude);

echo "\n";

echo "\n";
if ($errArr[ERR_AFFECTED_ROWS] == 1) {
	echo $passed;
	$result[$res_key]=$passed;
}
else {
	echo $failed;
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