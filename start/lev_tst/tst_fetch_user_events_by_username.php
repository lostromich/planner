<?php
// *** This testing program is replaced with tst_fetch_user_events_by_email
// 
//
// // Test selection all events for the user
// include_once '../includes/constants.inc.php';
// include_once '../includes/crypt_pssw.inc.php';
// include_once '../includes/sql_functions.inc.php';
// include_once 'tst_connect.inc.php';       // added password

// $tst_counter=0;
// // Test Select user by username
// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";
// echo " ==================================================================== ";
// echo "test by user name \n";
// echo " ==================================================================== ";


// list($errArr, $events) = fetch_user_events_by_username('lostromich');  
// print_r($events);
// print_r ($errArr);

// // Test Select user by username
// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";
// echo " ==================================================================== \n";
// echo "test by user name and start date \n";
// echo " ==================================================================== \n";

// list($errArr, $events) = fetch_user_events_by_username('lostromich','2012-12-31 15:10:00');

// print_r($events);
// print_r ($errArr);

// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";

// // Test Select user by username, start date and end date
// echo " ==================================================================== \n";
// echo "test by user name and start date     and end date \n";
// echo " ==================================================================== \n";

// list($errArr, $events) = fetch_user_events_by_username('lostromich','2014-12-30 23:59:00','2014-12-31 00:00:01');

// print_r($events);
// print_r ($errArr);

// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";

// // Test Select user by username, start date and end date and privacy
// echo " ==================================================================== \n";
// echo "test by user name and start date     and end date and privacy - all privacies\n";
// echo " ==================================================================== \n";

// list($errArr, $events) = fetch_user_events_by_username('lostromich','2014-12-30 23:59:00','2014-12-31 00:00:01', PRIVACY_ALL);

// print_r($events);
// print_r ($errArr);

// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";
// // Test Select user by username, start date and end date and privacy
// echo " ==================================================================== \n";
// echo "test by user name and start date     and end date and privacy - Public \n";
// echo " ==================================================================== \n";

// list($errArr, $events) = fetch_user_events_by_username('lostromich','2014-12-30 23:59:00','2014-12-31 00:00:01', PRIVACY_PUBLIC);

// print_r($events);
// print_r ($errArr);

// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";
// // Test Select user by username, start date and end date and privacy
// echo " ==================================================================== \n";
// echo "test by user name and start date     and end date and privacy - Private \n";
// echo " ==================================================================== \n";

// list($errArr, $events) = fetch_user_events_by_username('lostromich','2014-12-30 23:59:00','2014-12-31 00:00:01', PRIVACY_PRIVATE);
// print_r($events);
// print_r ($errArr);

// $tst_counter++;
// echo "Test NUmber: " . $tst_counter . "\n";
// // Test Select user by username, start date and end date and privacy
// echo " ==================================================================== \n";
// echo "test by user name and Min date, max date and privacy - Private \n";
// echo " ==================================================================== \n";

// list($errArr, $events) = fetch_user_events_by_username('lostromich',MIN_DATE_TIME, MAX_DATE_TIME, PRIVACY_PRIVATE);
// print_r($events);
// print_r ($errArr);

// //

// echo " ==================================================================== \n";
// echo "test all users and evvents but select specific role \n";
// echo " ==================================================================== \n";

// $role_to_select = 3;
// $sql_role_selection = "=" . $role_to_select;
// list($errArr, $events) = fetch_user_events_by_username(ZERO_LENGTH_STRING, MIN_DATE_TIME, MAX_DATE_TIME, PRIVACY_ALL, 
// 		$sql_role_selection );
// print_r($events);
// print_r ($errArr);


// echo " ==================================================================== \n";
// echo "test all users and evvents but select roles between 1 and 2          \n";
// echo " ==================================================================== \n";

// $role_to_select_start  = 1;
// $role_to_select_end    = 2;
// $sql_role_selection = " BETWEEN " . $role_to_select_start . " AND "  .$role_to_select_end;
// list($errArr, $events) = fetch_user_events_by_username(ZERO_LENGTH_STRING, MIN_DATE_TIME, MAX_DATE_TIME, PRIVACY_ALL,
// 		$sql_role_selection );
// print_r($events);
// print_r ($errArr);

?>


