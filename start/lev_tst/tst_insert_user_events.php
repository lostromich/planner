<?php
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';

include_once 'tst_connect.inc.php';       // added password

// Insert 
$errArr = insert_user_events(5,4,3);
print_r($errArr);

$errArr = insert_user_events(5,7);
print_r($errArr);

?>


