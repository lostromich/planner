<?php

// Test select users attending the event 
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

// Test users attending the event 
echo " ==================================================================== \n ";
echo "test selection all users attending the event \n";
echo " ==================================================================== \n";

$event_id =1;
echo "Event id: " . $event_id . "\n";
list($errArr, $users) = fetch_users_attending_event($event_id); 
var_dump($users);
var_dump($errArr);

// Test users attending the event 
echo " ==================================================================== \n ";
echo "test selection all users attending the event (it should be no users) \n";
echo " ==================================================================== \n";

$event_id =99999;
echo "Event id: " . $event_id . "\n";
list($errArr, $users) = fetch_users_attending_event($event_id); 

var_dump($users);
var_dump($errArr);


?>
