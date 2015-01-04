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
echo "test select all top events                                            \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_1";
echo " \n";

list($errArr, $top_events) = fetch_top_events();  

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";
echo " ==================================================================== \n";
echo "test few top  events with tag selection                               \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_1a";
echo " \n";

$sdate_time=MIN_DATE_TIME;
$edate_time=MAX_DATE_TIME;
$eventName=NULL;
$location=NULL;
$genres=NULL;
$privacy=NULL;
$event_status=NULL;
$tag_name="sleeping";
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=2;

echo " Fetch :" . $fetch_top_n . " top users \n";
echo " Select only tags: " . $tag_name . "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,  $privacy,  $event_status,
		$tag_name,     $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";


echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test few top  events                                                  \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_2";
echo " \n";

$sdate_time=MIN_DATE_TIME;
$edate_time=MAX_DATE_TIME;
$eventName=NULL;
$location=NULL;
$genres=NULL;
$privacy=NULL;
$event_status=NULL;
$tag_name=NULL;
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=2;

echo " Fetch :" . $fetch_top_n . " top users \n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time, 
		       $eventName,    $location, $genres,  $privacy,  $event_status, 
		       $tag_name,     $role_ids,
		       $country_code, $city,      $province_code, $street_name, $postal_code,
		       $latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by date                      \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_3";
echo " \n";

$sdate_time="2013-12-25 02:00:05";
$edate_time="2013-12-25 03:00:00";
$eventName=NULL;
$location=NULL;
$genres=NULL;
$privacy=NULL;
$event_status=NULL;
$tag_name=NULL;
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=2;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,  $privacy,  $event_status,
		$tag_name,  $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by event name                \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_4";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName="johnsDance";
$location=NULL;
$genres=NULL;
$privacy=NULL;
$event_status=NULL;
$tag_name=NULL;
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=2;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
echo " event name: " . $eventName;
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,  $privacy,  $event_status,
		$tag_name, $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by location                  \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_5";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName=NULL;
$location="riding solo"; 
$genres=NULL;
$privacy=NULL;
$event_status=NULL;
$tag_name=NULL;
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=2;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
echo " location : " . $location; 
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres, $privacy,   $event_status,
		$tag_name,  $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by genre                     \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_6";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName=NULL;
$location=NULL;
$genres=array("bar", "nature"); 
$privacy=NULL;
$event_status=NULL;
$tag_name=NULL;
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=10;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
print_r ( $genres);
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,  $privacy,  $privacy, $event_status,
		$tag_name,  $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by genre and event Status     \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_7";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName=NULL;
$location=NULL;
$genres=array("bar", "nature");
$privacy=NULL;
$event_status=STATUS_ACTIVE;
$tag_name=NULL;
$role_ids=NULL;
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=10;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
print_r ( $genres);
echo "\n";
print_r($event_status);
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,   $privacy, $event_status,
		$tag_name, $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by genre and event Status    \n";
echo " and role ids                                                         \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_8";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName=NULL;
$location=NULL;
$genres=array("bar", "nature");
$privacy=NULL;
$event_status=STATUS_ACTIVE;
$tag_name=NULL;
$role_ids=array(3,4);       // select roles 3 and 4 only
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=10;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
print_r ( $genres);
echo "\n";
print_r($event_status);
echo "\n";

print_r($event_status);
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,   $privacy, $event_status,
		$tag_name,  $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";


echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by genre and event Status    \n";
echo " and role ids      and privacy                                        \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_8";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName=NULL;
$location=NULL;
$genres=array("bar", "nature");
$privacy=PRIVACY_PRIVATE;  
$event_status=STATUS_ACTIVE;
$tag_name=NULL;
$role_ids=array(3,4);       // select roles 3 and 4 only
$country_code=NULL;
$city=NULL;
$province_code=NULL;
$street_name=NULL;
$postal_code=NULL;
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=10;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
print_r ( $genres);
echo "\n";
print_r($event_status);
echo " Privacy : " . $privacy ." \n";


print_r($event_status);
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,   $privacy, $event_status, 
		$tag_name, $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo "test few top events and include slection by genre and event Status    \n";
echo " and role ids      and Country and city, province                     \n";
echo " street name, postal code                                                          \n";
echo " ==================================================================== \n";
$res_key="fetch_top_events_8";
echo " \n";

$sdate_time="2010-12-25 02:00:05";
$edate_time="2015-12-25 03:00:00";
$eventName=NULL;
$location=NULL;
$genres=array("bar", "nature");
$privacy=PRIVACY_PRIVATE;
$event_status=STATUS_ACTIVE;
$tag_name=NULL;
$role_ids=array(3,4);       // select roles 3 and 4 only
$country_code="Canada";
$city="Thornhill";
$province_code="ON";
$street_name="roxborugh lane";
$postal_code="l4j4t5";
$latitude=NULL;
$longitude=NULL;
$distance_km=NULL;
$fetch_top_n=10;

echo " Fetch :" . $fetch_top_n . " top users, Date time: " . $sdate_time . " " . $edate_time . "  \n";
print_r ( $genres);
echo "\n";
print_r($event_status);
echo " Privacy : " . $privacy . " country : " . $country_code . "  " . $city . " " . $province_code . "  \n";
echo " Street: " . $street_name . " " . $postal_code . "   \n";


print_r($event_status);
echo "\n";

list($errArr, $top_events) = fetch_top_events($sdate_time, $edate_time,
		$eventName,    $location, $genres,   $privacy, $event_status,
		$tag_name,  $role_ids,
		$country_code, $city,      $province_code, $street_name, $postal_code,
		$latitude,     $longitude, $distance_km,   $fetch_top_n);

echo "\n";
if (count($top_events) > 0 ) {
	$result[$res_key]=$passed;
}
else {
	$result[$res_key]=$failed;
}
echo "\n";

print_r($top_events);
print_r ($errArr);

echo " \n";

echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);

?>


