<?php
// Test delete role description 
include_once '../includes/constants.inc.php';
include_once '../includes/crypt_pssw.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password


echo " ==================================================================== \n";
echo "test delete 1 role descr \n";
echo " ==================================================================== \n";


$errArr = delete_role_descr(3); 
print_r($roles);
print_r ($errArr);


echo " ==================================================================== \n";
echo "test if role was deleted  \n";
echo " ==================================================================== \n";


list($errArr, $roles) = fetch_role_descr(0, FETCH_ALL);   
print_r($roles);
print_r ($errArr);



?>


