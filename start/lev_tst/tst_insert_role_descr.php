<?php
// Test insert role description ';
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password


echo " ==================================================================== \n";
echo "Insert 1 role description \n";
echo " ==================================================================== \n";


$errArr = insert_role_descr (3, "Attending");  
print_r ($errArr);


echo " ==================================================================== \n";
echo "test if role was inserted \n";
echo " ==================================================================== \n";


list($errArr, $roles) = fetch_role_descr(0, FETCH_ALL);   
print_r($roles);
print_r ($errArr);



?>


