<html>
<head>
<title>tst_fetch_role_descr.php</title>
</head>
<body>

<?php

// Test selection fetch role descriptions
include_once '../includes/constants.inc.php';
//include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password

function fetch_role_descr1 ($role_id, $fetch_option=FETCH_ALL) {
	global $cxn;
	// Initialize variables
	$roles = array();

	$errArr=array(ERR_CODE=>0, ERR_FUNCTION_NAME=>__FUNCTION__, ERR_DESCR=>"", ERR_LONG_DESCR=>"", ERR_SQLSTATE=>"");
	try
	{
		// Set up WHERE condition depending on passed parameters
		if ($fetch_option===FETCH_ALL) {
			$where = " " ;
		}
		else {
			$where = " WHERE role_id=? ";
		}
		// Sql String
		$sqlString = "SELECT *
					  FROM role_descr "
				. $where .
				" ORDER BY role_id  ";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		if ($fetch_option==FETCH_ALL) {
			// no action
		}
		else {
			$stmt->bind_param("i", $role_id);
		}

		$stmt->execute();
		// Store result
		/* Bind results to variables */
		$result=$stmt->get_result();

		while ($row = $result->fetch_assoc()) {
			$roles[]=$row;
		}

	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$errArr[ERR_CODE]=1;
		$errArr[ERR_DESCR]="Error selecting from friends, users  with user_id: " . $user_id;
		$errArr[ERR_LONG_DESCR]=$err->getMessage();
		$errArr[ERR_SQLSTATE]=$err->getCode();
	}
	// Return Error code
	return $roles;
}
function bind_array($stmt, &$row) {
	$md = $stmt->result_metadata();
	$params = array();
	while($field = $md->fetch_field()) {
		$params[] = &$row[$field->name];
	}

	call_user_func_array(array($stmt, 'bind_result'), $params);
}

// ....


// Test Select user by username
echo " ==================================================================== \n ";
echo "<br>";
echo "test selection all role descriptions \n";
echo "<br>";
echo " ==================================================================== \n";
echo "<br>";
// phpinfo();
//echo "Test";
//$roles = fetch_role_descr1(1, FETCH_ALL); 
//
//
//
$roles=array();
$sqlString = "SELECT *
					  FROM role_descr ";
	
// Bind variables
// $stmt = $mysqli->stmt_init();
//
function cvt_to_key_values(&$row) {
	$row_out=array();
	foreach ($row as $k => $v) {
		$row_out[$k] = $v;
	}
	return $row_out;
}
//

$stmt = $cxn->prepare($sqlString);
$stmt->execute();
echo "after execute \n <br>";
$roles=NULL;

bind_array($stmt, $row);
while ($stmt->fetch()) {
	
	$roles[]=cvt_to_key_values($row);
	
}


// $roles=NULL;

// bind_array($stmt, $row);
// while ($stmt->fetch()) {

// 	echo json_encode($row);
// 	$row_out=array();
// 	foreach ($row as $k => $v) {
// 		$row_out[$k] = $v;
// 	}
// 	$roles[]=$row_out;

// }



// Store result
/* Bind results to variables */
// try {
// 	$result=$stmt->get_result();
// }
// catch (Exception $e) {
// 	//echo "after result";
// 	echo $e->getMessage();
// }

// echo "after extension";
// while ($row = $result->fetch_assoc()) {
// 	print_r($row);
// 	$roles[]=$row;
// }

// $stmt->bind_result($role_id, $role_descr);

// /* fetch values */
// while ($stmt->fetch()) {
// 	$row["role_id"] = $role_id;
// 	$row["role_descr"] = $role_descr;
	
// 	$roles[]=$row;
// }

echo "after while";
var_dump($roles);

// echo "<br>";

// echo "<br>";
// print_r($roles);
// echo "<br>";
// print_r ($errArr);


// // Test Select user by username
// echo " ==================================================================== \n";
// echo "test selection 1 role descriptions \n";
// echo " ==================================================================== \n";


// list($errArr, $roles) = fetch_role_descr(3, FETCH_ONE);
// print_r($roles);
// print_r ($errArr);

?>

</body>
</html>
