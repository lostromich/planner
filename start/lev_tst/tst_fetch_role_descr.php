<?php

// Test selection fetch role descriptions
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

// Test Select user by username
echo " ==================================================================== \n ";
echo "test selection all role descriptions \n";
echo " ==================================================================== \n";


list($errArr, $roles) = fetch_role_descr(); 
echo "after select";
var_dump($roles);

// Test Select user by username
echo " ==================================================================== \n";
echo "test selection 1 role descriptions \n";
echo " ==================================================================== \n";


list($errArr, $roles) = fetch_role_descr(3);
print_r($roles);
print_r ($errArr);

?>

</body>
</html>
