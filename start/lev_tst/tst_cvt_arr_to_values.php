<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

$result=array();
$passed = " ************************ passed ************************";
$failed = " ************************ failed ************************";
// 
//
echo " ==================================================================== \n";
echo "test convert array to values                                          \n";
echo " ==================================================================== \n ";
$res_key="test_1";
$event_id=1;

echo " Event id: " . $event_id;  
echo " \n";

list($errArr,$events) = fetch_events($event_id);

if (count($events) > 0) {
	$row = $events[0];
	list($eID, $eventName, $location, $genre, $url, $sdate_time, $edate_time,
			$privacy, $event_descr, $event_status, $addr_id, $parent_event_id) = cvt_arr_to_values($row);
	echo " Row key-values: " ;
	print_r ($row); 
	echo " \n";
		
	echo " \n";
	echo " Row values: ";
	
	echo "eID: " . $eID; 
	echo " \n";
	
	echo "eventName: " . $eventName; 
	echo " \n";
	
	echo "location: " . $location;
	echo " \n";
	
	echo "genre: " . $genre;
	echo " \n";
	
	echo "url: " .  $url; 
	echo " \n";
	
	echo "sdate_time: " . $sdate_time; 
	echo " \n";
	
	echo "edate_time: " . $edate_time;
	echo " \n";
	
	echo "privacy: " .$privacy; 
	echo " \n";
	
	echo  "event_descr: " .$event_descr;
	echo " \n";
	
	echo  "event_status: " .$event_status; 
	echo " \n";
	
	echo "addr_id: " .$addr_id; 
	echo " \n";
	
	echo "parent_event_id: " .$parent_event_id;
	echo " \n";
	
	echo " \n";
	
	//
	
	
	//
	
	$result[$res_key]=$passed;
}
	else {
		$result[$res_key]=$failed;

}

//
echo "\n";

print_r ($errArr);

echo " \n";
echo " ==================================================================== \n";
echo " Test  Results                                                        \n";
echo " ==================================================================== \n ";

print_r($result);
?>