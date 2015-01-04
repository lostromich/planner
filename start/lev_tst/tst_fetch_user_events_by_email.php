<?php

include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();

$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
//
echo " \n";
echo " ==================================================================== \n";
echo "test select all users all events                                      \n";
echo " ==================================================================== \n";
$res_key="test_1";
echo " \n";

list($errArr, $user_events) = fetch_user_events_by_email();   

echo "\n";
if (count($user_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($user_events);
print_r ($errArr);

echo " \n";
echo " ==================================================================== \n";
echo "test by start and end datetime                                        \n";
echo " ==================================================================== \n";
$res_key="test_2";
echo " \n";

$email= "lev.ostromich@gmail.com"; 
$sdate_time="2011-12-25 00:00:05";
$edate_time="2016-12-01 23:00:00";
$privacy=NULL;

$role_ids=NULL;

echo " Fetch Date time:" . $sdate_time . " " . $edate_time . "\n";

list($errArr, $user_events) = fetch_user_events_by_email($email, $sdate_time, $edate_time);

echo "\n";
if (count($user_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";
echo "\n";

print_r($user_events);
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test by email                                                         \n";
echo " ==================================================================== \n";
$res_key="test_3";
echo " \n";

$email= "lev.ostromich@gmail.com"; 
$sdate_time="2013-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$privacy=NULL;

$role_ids=NULL;
echo "\n" . "email: " . $email . "\n";
echo " Fetch Date time:" . $sdate_time . " " . $edate_time . "\n";

list($errArr, $user_events) = fetch_user_events_by_email($email, $sdate_time, $edate_time);

echo "\n";
if (count($user_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";
echo "\n";

print_r($user_events);
print_r ($errArr);
echo " \n";
echo " ==================================================================== \n";
echo "test by privacy                                                         \n";
echo " ==================================================================== \n";
$res_key="test_4";
echo " \n";

$email= "lev.ostromich@gmail.com";
$sdate_time="2013-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$privacy=PRIVACY_PUBLIC;

$role_ids=NULL;
echo "\n" . "email: " . $email . "\n";
echo " Fetch Date time:" . $sdate_time . " " . $edate_time . "\n";
echo "\n" . "privacy: " . $privacy . "\n";

list($errArr, $user_events) = fetch_user_events_by_email($email, $sdate_time, $edate_time, $privacy);

echo "\n";
if (count($user_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";
echo "\n";

print_r($user_events);
print_r ($errArr);
echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test by role                                                         \n";
echo " ==================================================================== \n";
$res_key="test_5";
echo " \n";

$email= "lev.ostromich@gmail.com";
$sdate_time="2013-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$privacy=PRIVACY_PUBLIC;
$role_ids=array(3,4);


echo "\n" . "email: " . $email . "\n";
echo " Fetch Date time:" . $sdate_time . " " . $edate_time . "\n";
echo "roles: " ;
print_r (  $role_ids);
echo "\n";

list($errArr, $user_events) = fetch_user_events_by_email($email, $sdate_time, $edate_time, $privacy, $role_ids);

echo "\n";
if (count($user_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";
echo "\n";

print_r($user_events);
print_r ($errArr);
echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test by tag name                                                      \n";
echo " ==================================================================== \n";
$res_key="test_6";
echo " \n";

$email= NULL;
$sdate_time="2013-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$privacy=NULL;

$role_ids=NULL;
$tag_name = "sleeping";
echo "\n" . "email: " . $email . "\n";
echo " Fetch Date time:" . $sdate_time . " " . $edate_time . " tag: " . $tag_name . "\n";

list($errArr, $user_events) = fetch_user_events_by_email($email, $sdate_time, $edate_time, $privacy, 
		$role_ids, $tag_name);

echo "\n";
if (count($user_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";
echo "\n";

print_r($user_events);
print_r ($errArr);
echo " \n";

echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);

?>


