<?php
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

// Test delete event from events table and delete users for this event from user_events table 

$errArr = delete_events(23); 

print_r ($errArr);

?>