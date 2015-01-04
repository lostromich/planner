<?php
/* ====================================================================================================================
 * History of change
* =====================================================================================================================
* Version | Name     |   Date     | Description 
* ---------------------------------------------------------------------------------------------------------------------  
* 1.00001 | Lev O    | 2013-09-02 | - fetch_users by username or email address   
*         |          |            | - created insert_user function
*         |          |            | - created fetch_user_events_by_username function (include option for start and  
*         |          |            |   end dates).
*         |          |            | - created role_id to user_events table 
*         |          |            | - created check_user_event_role to check if specific user has specific role  
*         |          |            |   for specific event.  
*         |          |            | - created insert_user_event function
*         |          |            |             
* 1.00002 |          | 2013-09-03 | - created function insert_events to insert an event     
*         |          |            | - created function delete_events with option to delete/not to delete user events            
*         |          |            | - created function delete_user_events_by_event_id           
*         |          |            |             
* 1.00003 |          | 2013-09-05 | - added privacy column to events table    
*         |          |            | - change insert_events function to include new column            
*         |          |            | - changed fetch_user_events_by_username and added $privacy parameter            
*         |          |            |   (default value is to select all privacies)          
*         |          |            | - created new table role_descr with Descritpions of the roles            
*         |          |            | - created function fetch_role_descr to fetch one or all role descriptions            
*         |          |            | - created function insert_role_descr to insert role description            
*         |          |            | - created function delete_role_descr to delete one role description            
*         |          |            | - change fetch_friends function to use username as parameter instead of user id             
*         |          |            | - change fetch_friends function to have DB key values (ID) in associative array    
*         |          |            |  
* 1.00004 |          | 2013-09-06 | - added function delete_user_events_by_user_event_id    
*         |          |            | - added function fetch_users_attending_event to get users and 
*         |          |            |     their roles attending the event   
*         |          |            |   
* 1.00005 |          | 2013-09-07 | - created new table repeat_events
*         |          |            | - created function fetch_repeat_events 
*         |          |            | - created function insert_repeat_events 
*         |          |            | - created function delete_repeat_events 
*         |          |            | - created foreign key constraint on repeat_events to events table  
*         |          |            | - changed fetch_user_events_by_username to include repeating events   
*         |          |            |      
* 1.00006 |          | 2013-09-08 | - changed fetch_user_events_by_user_name and added option to select all users 
*         |          |            |    
* 1.00007 |          | 2013-09-09 | - created frq_choice_descr table with Frequences Choice descriptions (DA, WK, MO). 
*         |          |            | - created repeat_events_frq_choice table to save Frequency choices     
*         |          |            | - created functions to select, insert , delete from the above tables     
*         |          |            |
* 1.00007 |          | 2013-09-10 | - created fetch_events funcion to select events by event_id and /or date time, privacy)
*         |          |            | 
* 1.00008 |          | 2013-09-11 | - changed function fetch_user_events_by_username  and added 
*         |          |            |    $select_role=SELECT_ALL_ROLES parameter       
*         |          |            | 
* 1.00009 |          | 2013-09-21 | - added event_descr to events table 
*         |          |            | - changed insert_events to have new parameter $event_descr
*         |          |            | - changed fetch_user_events_by_user_name to select $event_descr
*         |          |            | - reduce varchar length  
*         |          |            | - added $errArr[ERR_INSERT_ID] for auto-generated ids
*         |          |            | 
* 1.00010 |          | 2013-09-23 | - added gen_events function to create repeating events with pre-defined frequencies  
*         |          |            | 
* 1.00011 |          | 2013-09-29 | - added event_status column to the events table (Current values: Active, Cancelled)
*         |          |            | - added addr_id to the events table 
*         |          |            | - created address table 
*         |          |            | - created get_enum_values function to get enumerated values for the provieded table/column
*         |          |            |   (use this function to prompt them ind drop-down list)
*         |          |            | - created get_enum_values function to get enumerated values for the provieded table/column
*         |          |            | - created fetch_address function 
*         |          |            | - created insert_address function 
*         |          |            | - created delete_address funtion 
*         |          |            | 
* 1.00012 |          | 2013-10-06 | - added fetch_top_events to select most attended events
*         |          |            | - created view events_all_v : try SELECT * FROM events_all_v to see all events,
*         |          |            |   including repeating events
*         |          |            | - created view events_address_v : try SELECT * FROM events_address_v to see all events,
*         |          |            |   including repeating events and addresses
*         |          |            | - created view users_events_v to see user and events they attend
*         |          |            | - created view events_address_users_v to see user and events with addresses they attend
*         |          |            | - created view events_users_cnt_v to see events and number users attended this event
*         |          |            | 
* 1.00013 |          | 2013-10-13 | - changed users table to have status = Active, Inactive
*         |          |            | - dropped username from users table 
*         |          |            | - re-created users_events_v, events_address_users_v
*         |          |            | - change delete_events function - removed 1 parameter
*         |          |            | - created new function fetch_user_events_by_email to replace 
*         |          |            |   function fetch_user_events_by_username
*         |          |            | - created users_events_dtl_v view
*         |          |            | 
* 1.00014 |          | 2013-10-14 | - added parent_event_id column to events table
*         |          |            | - changed functions to include parent event id 
*         |          |            | - changed gen_events function to be able to generate "true" events 
*         |          |            |    (added one more paramter:RPT_EVENT_TYPE_DUPLICATE|RPT_EVENT_TYPE_SEPERATE)
*         |          |            |    (check tst_gen_events_duplicate to see examples) 
*         |          |            | - created delete_events_by_parent_id function
*         |          |            |
* 1.00015 |          | 2013-10-17 | - created gen_user_events_for_child_events function to attach users of the parent  
*         |          |            |     event to child events
*         |          |            | - created fetch_child_events function to retrieve child events by parent event id
*         |          |            |
* 1.00016 |          | 2013-10-21 | - created update_events function to update status and other values   
*         |          |            | - created update_users function to update users table  
*         |          |            | - created update_address function to update address table  
*         |          |            | - created update_frq_choice_descr function to update frq_choice_descr table  
*         |          |            | - created update_user_events function to update user_events table  
*         |          |            |
* 1.00017 |          | 2013-11-05 | - created tst_map_intro.html.php with static map   
*         |          |            | - created tst_map_with_sql.html.php with dynamic map
*         |          |            | - created tst_map_with_sql_functions.html.php with dynamic map
*         |          |            | - created map_functions.js in includes folder
*         |          |            | 
* 1.00017 |          | 2013-11-24 | - added tags to the events table, modified viewes to include tags
*         |          |            | - created sql_statements folder to keep sql statements there
*         |          |            | - added tag_name to fetch_user_events_by_email function
*         |          |            | - added tag_name to fetch_events function
*         |          |            | - added tag_name to insert_events function
*         |          |            | - added tag_name to fetch_top_events function
*         |          |            |
*         |          |            |
*         |          |            |
* =====================================================================================================================
*/

/* ==================================================================
* Manage Sql error array / data 
* ==================================================================
*/

/* ==================================================================
 *  Signature  : ($function_name) -> array($errArr)
* Description: Initialize and return error array
* Author: Lev O
* Date  : 2013-09-07
* ==================================================================
*/
function init_errArr ($function_name) {
	return(array(ERR_CODE=>0, ERR_FUNCTION_NAME=>$function_name, ERR_DESCR=>"",
		ERR_LONG_DESCR=>"", ERR_SQLSTATE=>"", ERR_SQLSTATE_MSG=>"", ERR_AFFECTED_ROWS=>0, ERR_INSERT_ID=>0));
}

/* ==================================================================
 *  Signature  : ($err, $err_code, $err_descr,  &$errArr) 
* Description: Set up values in error Array 
* Author: Lev O
* Date  : 2013-09-07
* ==================================================================
*/
function set_errArr ($err, $err_code, $err_descr, &$errArr)  {
	$errArr[ERR_CODE]  = $err_code;
	$errArr[ERR_DESCR] = $err_descr; 
	if ($err == NULL) {
		$errArr[ERR_LONG_DESCR] = ZERO_LENGTH_STRING;
	}
	else {
		$errArr[ERR_LONG_DESCR] = $err->getMessage();
	}
}

/* ==================================================================
 * Manage result set - help for convertion to associative array
* ==================================================================
*/
/* ==================================================================
 *  Signature  : ($stmt, &$row) -> (array($errArr), $hash)
* Description: Get metadata (field names) from statement and use these names 
*   to set up statement with field names.
* Example    : $bind_array($stmt, $row); 
* Author: Lev O
* Date  : 2013-09-06
* ==================================================================
*/
function bind_array($stmt, &$row) {
	$md = $stmt->result_metadata();
	$params = array();
	while($field = $md->fetch_field()) {
		$params[] = &$row[$field->name];
	}

	call_user_func_array(array($stmt, 'bind_result'), $params);
}

/* ==================================================================
 *  Signature  : (&$row) -> array($row_out) 
* Description: Get an array and re-assign key and values of the array to
*   output array which is returned to the calling program .
*   (This logic allow to overcome PHP Opimization with arrays in aloop and $stmt-> fetch situation. 
*  
* Example    : $row_out = cvt_to_key_values(&$row);
* Author: Lev O
* Date  : 2013-09-06
* ==================================================================
*/
function cvt_to_key_values(&$row) {
	$row_out=array();
	foreach ($row as $k => $v) {
		$row_out[$k] = $v;
	}
	return $row_out;
}

/* ==================================================================
 * Manage passwords
* ==================================================================
*/
/* ==================================================================
 *  Signature  : ($email, $password) -> (array($errArr), $hash)
* Description: Update password for the provided user name and return hashed password.
* Example    : list($errArr, $hash)= update_password('lev.ostromich@gmail.com', 'planner1');
* Author: Lev O
* Date  : 2013-08-29
* ==================================================================
*/
function update_password($email, $password) {
	global $cxn;
	$hash=NULL;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Hash the password
		$hash = cryptPssw($email, $password);
		// Sql String
		$sqlString = "UPDATE users
				SET password=?
				WHERE email =?";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("ss", $hash, $email);

		$stmt->execute();
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error updating password email: " . $email;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $hash);
}

/* ==================================================================
 *  Signature  : ($email, $plain_password) -> (boolean $valid_pssw)
* Description: Validate password for the provided user id and plain text password
*  and return true if password is valid.
* Example    : if (validate_password('lev.ostromich@gmail.com', 'planner1')) {Do something};
* Author: Lev O
* Date  : 2013-08-29
* ==================================================================
*/
function validate_password($email, $plain_password) {
	$valid_pssw = FALSE;

	// Get the user's row from DB:
	list($errArr, $users) = fetch_users($email);
	if (count($users) > 0) {
		$user=$users[0];
		$hash=$user["password"];
								
		$valid_pssw =chkPssw($email, $plain_password, $hash);
	}
	
	return $valid_pssw;
}

/* ==================================================================
 *  Signature  : ($table_name, $column_name) -> ($errArr, $enum_values)
* Description: Retrieve enumeration values for the provided table and dcolumn name.
*  
* Author: Lev O
* Date  : 2013-09-26
* ==================================================================
*/

function get_enum_values($table_name, $column_name) {
	global $cxn;
	
	$errArr=init_errArr(__FUNCTION__);
	$enum_values  = NULL;
	
	try {
		$sqlString = "
				SELECT COLUMN_TYPE
				FROM INFORMATION_SCHEMA.COLUMNS
				WHERE TABLE_NAME = '" . $cxn->real_escape_string($table_name) . "' AND
						COLUMN_NAME = '" . $cxn->real_escape_string($column_name) . "'
								";
		
		$stmt = $cxn->prepare($sqlString);
		$stmt->execute();
		/* Bind results to variables */
		$stmt->bind_result($row);
		$stmt->fetch();
		
		$enum_values = explode(",", str_replace("'", "", substr($row, 5, (strlen($row)-6))));
		sort($enum_values);
		
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting enumeration list, table: " . $table_name . " column: " . $column_name;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	//
	return array($errArr, $enum_values);
}

/* ==================================================================
*  Signature : ($event_id, $frq, $rpt_events_start, $rpt_events_end, 
*              $rpt_event_type=RPT_EVENT_TYPE_DUPLICATE|RPT_EVENT_TYPE_SEPARATE) -> ($errArr)
* Description: Generate repeating events using provided frequency.
*              Program is generating Start Date Time and End Date Time using Time of the 
*              Parent event (Note: all repeating events happen at the same time).
*               
* Important  : this function first deletes exiting repeating occurances of the event and
*                deletes last choice of repeating events.  
*              
* Example    : $errArr = gen_events(77, FRQ_MONTHLY, '2013-09-15 15:00:00', '2013-12-31 16:00:00', RPT_EVENT_TYPE_SEPARATE);
* Author: Lev O
* Date  : 2013-09-15
* ==================================================================
*/
function gen_events($event_id, $frq, $rpt_events_start, $rpt_events_end, $rpt_event_type=RPT_EVENT_TYPE_DUPLICATE) {
	global $cxn;
	$errArr=init_errArr(__FUNCTION__);
	// Do not go to the loop if Frequency is not valid
	if ($frq != FRQ_DAILY AND $frq != FRQ_MONTHLY AND $frq != FRQ_WEEKLY) {
		$errArr[ERR_CODE]  = 1;
		$errArr[ERR_DESCR] = "Invalid Frequncy: " . $frq;
		return $errArr;
	}

	// Delete frequency selection
	$errArr=delete_repeat_events_frq_choice($event_id);
	if (!$errArr[ERR_CODE]) {
		// Create new frequency choice
		insert_repeat_events_frq_choice($event_id, $frq, $rpt_events_start, $rpt_events_end);
		// If not error delete repeating events in provided period
		if (!$errArr[ERR_CODE]) {
			// Delete all repeating events because we are going to generate new repeating events
			if ($rpt_event_type == RPT_EVENT_TYPE_DUPLICATE) {
				$errArr = delete_events_by_parent_id($event_id);
			}
			else {
			    $errArr = delete_repeat_events($event_id);
			}
			if (!$errArr[ERR_CODE]) {
				// Get event record from Parent record including start and end date which we need later
				list($errArr,$event)=fetch_events($event_id);
				if (!$errArr[ERR_CODE] AND count($event) > 0 ) {
					// Set upariables of the Parent event
					$event_row=$event[0];
					// Convert event row to variables
					list($eID, $eventName, $location, $genre, $url, $sdate_time, $edate_time, $privacy, 
		               $event_descr, $event_status, $addr_id, $parent_event_id) = cvt_arr_to_values($event_row);
					// set up Parent event id
					$parent_event_id = $event_id;
					//
					// Convert to DateTime Object
					$start_time = new DateTime($sdate_time);
					$end_time   = new DateTime($edate_time);
					// Set up Start and end Time to be used to set up time of the next event
					$start_time_hour    = $start_time->format("H");
					// echo "---" . $start_time_hour;
					$start_time_minute  = $start_time->format("i");
					$start_time_second  = $start_time->format("s");
					$end_time_hour      = $end_time->format("H");
					$end_time_minute    = $end_time->format("i");
					$end_time_second    = $end_time->format("s");
					// Calculate difference in days between Start Date_time event and end Date_time event
					// This days wil be used to set up end date time of the event
					$diff      = $start_time->diff($end_time);
					$diff_days = $diff->d;
					//
					// Set up start Date and Time of the first event
					//
					$curr_date_time           = new DateTime($rpt_events_start);
					$rpt_events_end_date_time = new DateTime($rpt_events_end);
					//
					// Produce repeating events
					//
					while ($curr_date_time <= $rpt_events_end_date_time) {
						// Set up start date time
						$curr_date_time->setTime($start_time_hour, $start_time_minute, $start_time_second);
						// Set up end date time
						$new_end_date_time = $curr_date_time;
						$new_end_date_time->modify("+{$diff_days} day");
						$new_end_date_time->setTime($end_time_hour, $end_time_minute, $end_time_second);
						// Convert to string
						$new_start_date_time_str = $curr_date_time->format(DFT_DATE_TIME_FORMAT);
						$new_end_date_time_str   = $new_end_date_time->format(DFT_DATE_TIME_FORMAT);
						//
						// Check if it is not equal to parent to avoid duplication
						//
						if ($new_start_date_time_str != $sdate_time) {
							if ($rpt_event_type == RPT_EVENT_TYPE_DUPLICATE) {
								// Duplicate Parent event using different start and end date and time
								$errArr = insert_events($eventName, $location, $genre, $url,
										$new_start_date_time_str, $new_end_date_time_str,
										$privacy, $event_descr, $event_status, $addr_id, $parent_event_id);
							}
							else {
								$errArr = insert_repeat_events($event_id, 
										$new_start_date_time_str, $new_end_date_time_str);
							}
						}
						// set up next period date - change current date time
						switch ($frq) {
							case FRQ_DAILY:
								$curr_date_time->modify('+1 day');
								break;
							case FRQ_MONTHLY:
								$curr_date_time->modify('+1 month');
								break;
							case FRQ_WEEKLY:
								$curr_date_time->modify('+1 week');
								break;
							default:
								return $errArr;
						}    // End Switch
					}    // End while loop
				}    // End fetch_events
			}    // End Error handling for delete_repeat_events
		}    // End Error handling insert_repeat_events_frq_choice
	}    // End Error handling for delete_repeat_events_frq_choice
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
} // End function
/* ==================================================================
 * Manage users
* ==================================================================
*/

/* ==================================================================
* Signature  : ($email=NULL) -> (array($errArr, array($ret_user) )
* Description: Select user information for the provided user  email. 
*   This function return an array with 1 row - assoctive array with column names=>values
*   
* Example    : list($errArr, $users) = fetch_users('lev.ostromich@gmail.com');
*  - fetch all users:
*             list($errArr, $users) = fetch_users(); 
* Author: Lev O
* Date  : 2013-08-31
* ==================================================================
*/
function fetch_users($email=NULL) {
	global $cxn;
	// Initialize variables
	$ret_user=NULL;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		if ($email != NULL) {
			$sqlString = "SELECT *
					FROM users
					WHERE email=?";
			// Bind variables
			$stmt = $cxn->prepare($sqlString);
			$stmt->bind_param("s", $email);
		}
		else {
			$sqlString = "SELECT *
					FROM users	
					ORDER BY email" ;
			// Bind variables
			$stmt = $cxn->prepare($sqlString);
		}

		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$ret_user[]=cvt_to_key_values($row);
		}
						
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting user with email:  " . $email;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $ret_user);
}


/* ==================================================================
 *  Signature  : ($firstName, $lastName, $email, $password, 
 *   $d_o_b, $gender, $status ) -> array($errArr)
* Description: Insert record into users DB table
* Example    :
* $errArr = insert_users('lev', 'ostromich', 'lev@ostromich@gmail.com', ' ',  '1999-12-31', 'Male','Active'); 
* Author: Lev O
* Date  : 2013-09-02
* ==================================================================
*/

function insert_users($firstName, $lastName, $email, $password, $d_o_b, $gender, $status ) {
	global $cxn;

    $errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "INSERT INTO users (firstName, lastName, email, password, d_o_b, gender, status)
				VALUES (?, ?, ?, ? ,?, ?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		
		$stmt->bind_param("sssssss", $firstName, $lastName, $email, $password, $d_o_b, $gender, $status );
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting users, email: " . $email;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	$errArr[ERR_INSERT_ID]     = $cxn->insert_id;
	return $errArr;
}

/*
 *  ==================================================================
* Signature  : ($ID, $set_arr) -> $errArray
*     $set_arr is array of key-values where keys are column names and value is value
*               the appropriate column has to be set up to passed value.
*
* Description: Update any column of the users table
*
* Tip        : if $ID is = NULL then all records in the table will be updated (it could be dangerous!).
* Author: Lev O
* Date  : 2013-10-27
* ==================================================================
*/
function update_users ($ID, &$set_arr) {
	// Initialize variables
	$errArr=init_errArr(__FUNCTION__);
	// Construct passing parameters
	$table_name       = "users";
	$key_arr          = array();
	$key_1            = "ID";                      // this is key column from events table
	$key_arr [$key_1] = $ID;                       // set up value to the key

	// call the universal function to do the update
	$errArr = update_any_table($table_name, $key_arr, $set_arr) ;

	return $errArr;
}

/* ==================================================================
 * Manage user_events
* ==================================================================
*/

/* ==================================================================
 *  Signature  : (int $user_id) -> (array($errArr, array($event_ids)
 * Description: Select all events for the provided user id
 * Author: Lev O
 * Date  : 2013-07-25
 * ==================================================================
 */
function fetch_user_events($user_id) {
	global $cxn;
	// Initialize variables
	$event_ids=NULL;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "SELECT event_id
				FROM user_events
				WHERE user_id=?
				ORDER BY event_id";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("i", $user_id);

		$stmt->execute();

		/* Bind results to variables */
		$stmt->bind_result($event_id);

		/* fetch values */
		while ($stmt->fetch()) {
			$event_ids[]=$event_id;
		}

	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting event_id with user_id: " . $user_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $event_ids);
}

/*
 *  ==================================================================
 *  Signature  : ($email, int $event_id, int $role_id) -> boolean $user_on_role)
 * Description: Check if provided user has specific role for the provided event.
 * Author: Lev O
 * Date  : 2013-09-02
 * ==================================================================
 */
function check_user_event_role($email, $event_id, $role_id) {
	global $cxn;
	// Initialize variables
	$user_on_role=FALSE;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "SELECT TRUE
				FROM users JOIN user_events ON
				     users.ID = user_events.user_id
				WHERE users.email          = ? AND 
				      user_events.event_id = ? AND 
				      user_events.role_id  = ?"; 

		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("sii", $email, $event_id, $role_id);

		$stmt->execute();

		/* Bind results to variables */
		$stmt->bind_result($user_on_role);

		/* fetch values */
		$stmt->fetch() ; 
		
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting role for email: " . $email . " event_id: " . $event_id . " role_id: " . $role_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $user_on_role;
}

/* ==================================================================
 *  Signature  : ([$pass_email = NULL, 
 *      $sdate_time=MIN_DATE_TIME, $edate_time=MAX_DATE_TIME,
 *		$privacy=NULL, $role_ids=NULL, tag_name=NULL]) -> (array($errArr, array($ret_events))
 *  (here $ret_events is associative array with information about events)
 *
 * Description: Select all events including detail information
 *              for the provided email
 * Author: Lev O
 * Date  : 2013-10-13
 * ==================================================================
 */
function fetch_user_events_by_email ($pass_email=NULL, $sdate_time=MIN_DATE_TIME, $edate_time=MAX_DATE_TIME,
 		        $privacy=NULL, $role_ids=NULL, $tag_name=NULL) {
 	global $cxn;
 	// Initialize variables
 	$ret_events=NULL;
 	// Check and replace start date time and end date time
 	if ($sdate_time == NULL ) {
 		$sdate_time = MIN_DATE_TIME;
 	} 
 	if ($edate_time == NULL ) {
 		$edate_time = MAX_DATE_TIME;
 	}

 	$errArr=init_errArr(__FUNCTION__);
 	try
	{
		// initialize variables
		$where        = ZERO_LENGTH_STRING;
		$param_types  = ZERO_LENGTH_STRING;
		$param_values = array();
		$sql_and      = " ";
		// Set email selection
		if ($pass_email != NULL) {
			$where = $where . $sql_and . " email = ? ";
			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
			$param_types      = $param_types . "s" ;  // add parameter type
			$param_values []  = $pass_email;          // add parameter value
		}
		// Set up date and time selection
		if ($sdate_time != MIN_DATE_TIME OR $edate_time != MAX_DATE_TIME) {
			$where =  $where . $sql_and .
			         " (sdate_time BETWEEN ? AND ? ) ";
			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
			// Initialize parameter types and parameter values
			$param_types  = $param_types . "ss";
			array_push($param_values, $sdate_time, $edate_time);
		}
		// set up privacy
		if ($privacy != NULL) {
			$where = $where . $sql_and . " privacy = ?";
			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $privacy;             // add parameter value
		}
		// set up Role selection
		if ($role_ids != NULL and count($role_ids) > 0) {
			$where = $where . $sql_and . " role_id IN (";
			$first_element=TRUE;
			foreach ($role_ids as $rid) {
				if ($first_element) {
					$first_element = FALSE;
					$comma = "";
				}
				else {
					$comma = ",";
				}
				$where = $where . $comma . "?";
				$param_types      = $param_types . "i";   // add parameter type
				$param_values []  = $rid;                 // add parameter value
			}
			$where = $where . ")";
			$sql_and          = " AND ";                 // set up "AND" value tobe used in following settings
		}
		//
		if ($tag_name != NULL) {
			$where = $where . $sql_and . " ( tag_1=? OR tag_2=? OR tag_3=? OR tag_4=? OR tag_5=? OR tag_6=? ) ";
			$sql_and          = " AND ";                   // set up "AND" value tobe used in following settings
			$i = 0;
			do {
				$param_types      = $param_types . "s" ;       // add parameter type
				$param_values []  = $tag_name;                 // add parameter value
				$i++;
			} while ($i < 6);
		}
		// Add WHERE keyword		
		if (trim($where) !== ZERO_LENGTH_STRING) {
			$where = " WHERE " . $where;
		}

		// SQL String
		$sqlString = "SELECT * "
			    	. " FROM users_events_dtl_v "
			    	. $where . 
			    	" ORDER BY sdate_time, eID";		
			 	
       	$stmt = $cxn->prepare($sqlString);
		// bind parameters 
		// Create array of types and their values
		$params=array_merge( array($param_types), $param_values);
				
	    if (count($param_values) > 0) {
			call_user_func_array ( array($stmt, "bind_param"), ref_values($params) );
		}
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$ret_events[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code  = 1;
		$err_descr = "Error selecting user events for the email: " . $pass_email . " " .
				$sdate_time . " " .  $edate_time . " " .
 		        $privacy . " " . $role_ids . " " . $tag_name;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $ret_events);
}
	
//
// 	{
// *** Function fetch_user_events_by_username is replaced wiht fetch_user_events_by_email ***
/* ==================================================================
 *  Signature  : ($pass_email
 *      [,$start_date_time=MIN_DATE_TIME, $end_date_time=MAX_DATE_TIME,
		        $privacy=PRIVACY_ALL, $select_role=SELECT_ALL_ROLES]) -> (array($errArr, array($ret_events)) 
 *  (here $events is associative array with information about events)
 *  
 * Description: Select all events including detail information 
 * for the provided email 
 * Author: Lev O
 * Date  : 2013-09-02
 * ==================================================================
 */
// function fetch_user_events_by_username($pass_email, $start_date_time=MIN_DATE_TIME, $end_date_time=MAX_DATE_TIME,
// 		        $privacy=PRIVACY_ALL,$select_role=SELECT_ALL_ROLES) {
// 	global $cxn;
// 	// Initialize variables
// 	$ret_events=NULL;
// 	$event=NULL;

// 	$errArr=init_errArr(__FUNCTION__); 
// 	try
// 	{
// 		// Set up Privacy selection using passed parameters
// 		if ($privacy==DFT_SELECT_PRIVACY) {
// 			$sqlstmt_privicay = " ";
// 		}
// 		else {
// 			$sqlstmt_privicay = " AND events.privacy = ?";
// 		}
		
// 		// Set up Privacy selection using passed parameters
// 		if ($pass_email ==ZERO_LENGTH_STRING)  {
// 			$sqlstmt_where_email = " ";
// 		}
// 		else {
// 			$sqlstmt_where_email = " users.email =? AND  ";
// 		}
		
// 		// SQL String
// 		$sqlString = 
// 		       "SELECT events.eID, events.eventName, events.location, events.genre, 
// 		       		events.url, events.sdate_time, events.edate_time, events.privacy, events.event_descr,
// 		       		events.event_status, events.addr_id,
// 		       		user_events.role_id,
// 		       		users.ID, firstName, lastName, email, d_o_b, gender,users.status
// 				FROM users JOIN user_events ON
// 				     users.ID=user_events.user_id 
// 				            JOIN events ON
// 				     user_events.event_id = events.eId
// 				WHERE " . $sqlstmt_where_email . 
// 				      " events.sdate_time between ? AND ? "
// 				 . $sqlstmt_privicay . 
// 				 " AND user_events.role_id " . $select_role .
// 				" UNION " .
// 				"SELECT repeat_events.event_id AS eID, events.eventName, events.location, events.genre,
// 		       		events.url, repeat_events.sdate_time, repeat_events.edate_time, events.privacy, events.event_descr,
// 					events.event_status, events.addr_id,	
// 		       		user_events.role_id, 
// 					users.ID, firstName, lastName, email, d_o_b, gender, users.status
// 				FROM users JOIN user_events ON
// 				     users.ID=user_events.user_id
// 				            JOIN events ON
// 				     user_events.event_id = events.eId
// 						    JOIN repeat_events ON
// 					 user_events.event_id = repeat_events.event_id	
// 				WHERE " . $sqlstmt_where_email . 
// 				      " repeat_events.sdate_time between ? AND ? "
// 						. $sqlstmt_privicay .
// 						" AND user_events.role_id " . $select_role .
// 				" ORDER BY sdate_time, eID";
// 		// Bind variables
// 		$stmt = $cxn->prepare($sqlString);
// 		// Use condition to bind parameters including/not including privacy selection
// 		if ($privacy==DFT_SELECT_PRIVACY) {
// 			if ($pass_email == ZERO_LENGTH_STRING) {
// 				$stmt->bind_param("ssss", $start_date_time, $end_date_time,
// 						                  $start_date_time, $end_date_time);
// 			}
// 			else {
// 			    $stmt->bind_param("ssssss", $pass_email, $start_date_time, $end_date_time,
// 					                        $pass_email, $start_date_time, $end_date_time);
// 			}
// 		}
// 		else {
// 			if ($pass_email == ZERO_LENGTH_STRING) {
// 			    $stmt->bind_param("ssssss", $start_date_time, $end_date_time, $privacy,
// 				    	                    $start_date_time, $end_date_time, $privacy);
// 			}
// 			else {
// 				$stmt->bind_param("ssssssss", $pass_email, $start_date_time, $end_date_time, $privacy,
// 						                      $pass_email, $start_date_time, $end_date_time, $privacy);
// 			}
// 		}

// 		$stmt->execute();
// 		// Store result 
// 		/* Bind results to variables */
// 		bind_array($stmt, $row);
// 		while ($stmt->fetch()) {
// 			$ret_events[]=cvt_to_key_values($row);
// 		}
// 	}
// 	catch (mysqli_sql_exception	$err)
// 	{
// 		// Error settings
// 		$err_code=1;
// 		$err_descr="Error selecting user events for the email: " . $pass_email;
// 		set_errArr($err, $err_code, $err_descr, $errArr);
// 	}
// 	// Return Error code
// 	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
// 	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
// 	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
// 	return array($errArr, $ret_events);
// }

/* ==================================================================
 *  Signature  : ($event_id) -> (array($errArr, array($users))
 *  
 * Description: Select all users and their role attending specific event  
 * Author: Lev O
 * Date  : 2013-09-06
 * ==================================================================
 */
function fetch_users_attending_event ($event_id)  {
	global $cxn;
	// Initialize variables
	$users=NULL;
	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// SQL String
		$sqlString = "SELECT users.*, user_events.role_id 
				FROM users JOIN user_events ON
				     users.ID=user_events.user_id
				WHERE user_events.event_id =?
				ORDER BY users.firstName, users.lastName";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("i", $event_id); 
		
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$users[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting users by event id: " . $event_id; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $users);
}
/* ==================================================================
 *  Signature  : ($user_id1, $event_id, $role_id=INSERT_DEFAULT_ROLE_ID) -> array($errArr)
* Description: Insert record into user_events table
* 
* Example: $errArr = insert_user_events(5,4,3);
*          $errArr = insert_user_events(5,7);
* Author: Lev O
* Date  : 2013-09-02
* ==================================================================
*/
function insert_user_events($user_id, $event_id, $role_id=INSERT_DEFAULT_ROLE_ID) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "INSERT INTO user_events (user_id, event_id, role_id)
				VALUES (?, ?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		
		$stmt->bind_param("iii", $user_id, $event_id, $role_id);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting user_events, user id: " . $user_id  . " event id: " .
		                     $event_id . " role id: " . $role_id; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}


/*
 *  ==================================================================
 *  Signature  : ($event_id) -> array($errArr)
 * Description: Delete an event from all users using passed event id
 * Author: Lev O
 * Date  : 2013-09-03
 * ==================================================================
*/
function delete_user_events_by_event_id($event_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "DELETE FROM user_events
				WHERE event_id = ?"; 
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		
		$stmt->bind_param("i", $event_id);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting user events , event id: " . $event_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}
/*
*  ==================================================================
*  Signature  : ($user_id, $event_id) -> array($errArr)
* Description: Delete specific event for the provided user from user_events table. 
* Author: Lev O
* Date  : 2013-09-06
* ==================================================================
*/
function delete_user_events_by_user_event_id($user_id, $event_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "DELETE FROM user_events
				WHERE user_id = ? AND
				      event_id  = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("ii", $user_id, $event_id);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting user events , user id: " . $user_id . " event id: " .$event_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/*
 *  ==================================================================
* Signature  : ($user_id, $event_id, $set_arr) -> $errArray
*     $set_arr is array of key-values where keys are column names and value is value
*               the appropriate column has to be set up to passed value.
*
* Description: Update any column of the user_events table
*
* Tip        : if $user_id or /and $event_id is = NULL then all records of this class will
*                 be updated  (it could be dangerous!).
* Author: Lev O
* Date  : 2013-10-27
* ==================================================================
*/
function update_user_events ($user_id, $event_id,  &$set_arr) {
	// Initialize variables
	$errArr=init_errArr(__FUNCTION__);
	// Construct passing parameters
	$table_name       = "user_events";
	$key_arr          = array();
	
	$key_arr ["user_id"]  = $user_id;                             // set up value to the key
	$key_arr ["event_id"] = $event_id;                            // set up value to the key
	// call the universal function to do the update
	$errArr = update_any_table($table_name, $key_arr, $set_arr) ;

	return $errArr;
}

/*
 *  ==================================================================
*  Signature  : ($parent_event_id) -> array($errArr)
* Description: Generate user events (attach users of the parent event to all 
*              child/repeating events).
* Author: Lev O
* Date  : 2013-10-17
* ==================================================================
*/
function gen_user_events_for_child_events($parent_event_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	// Fetch users of the parent event
	list($errArr, $users) = fetch_users_attending_event($parent_event_id);
	//
	// Check the error code
	//
	if (!$errArr [ERR_CODE] and (count($users) > 0)) {
		// get array of child events
		list($errArr, $events) = fetch_child_events($parent_event_id);
		if (!$errArr [ERR_CODE] and (count($events) > 0)) {
			// Loop through events and for every event generate user events record
			foreach ($events as $event) {
				// Loop through users inserting values into user event table
				$event_id = $event ['eID'];
				foreach ($users as $user) {
					$user_id = $user ['ID'];
					$role_id = $user ['role_id'];
					$errArr =  insert_user_events($user_id, $event_id, $role_id);
				} // end of users loop
			} // end of events loop
		} // end events condition, count($events) > 0
	} // end of users condition

	return $errArr;
}

/* ==================================================================
 * Manage friends
* ==================================================================
*/
/*
 *  ==================================================================
 *  Signature  : ($email) -> (array($errArr, array($fiends))
 * Description:
 * Select all 0-level friends ($ID, $firstName, $LastName,
 *		             $email, $d_o_b, $gender, $status) for the provided email
 * Author: Lev O
 * Date  : 2013-07-27
 * ==================================================================
 */
function fetch_friends($email) {
	global $cxn;
	// Initialize variables
	$friends=NULL;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = 
		        "SELECT users.ID, users.firstName, users.lastName,
				             users.email, users.d_o_b, users.gender, users.status
				  FROM users as users0 JOIN friends
				    ON users0.ID = friends.user_id1
				  JOIN users
				    ON friends.user_id2=users.ID
				  WHERE users0.email = ?
				UNION
				  SELECT users.ID, users.firstName, users.lastName,
			        	 users.email, users.d_o_b, users.gender, users.status
		          FROM users as users0 JOIN friends
				    ON users0.ID = friends.user_id2	
		          JOIN users	
				    ON friends.user_id1=users.ID
				  WHERE users0.email = ?
				  ORDER BY ID";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("ss", $email, $email );

		$stmt->execute();

		// Store result
		// Bind results to variables 
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$friends[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting from friends, users  with email: " . $email ;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $friends);
}

/* ==================================================================
 *  Signature  : ($user_id1, $user_id2) -> array($errArr)
* Description: Insert record into friends DB table
* Author: Lev O
* Date  : 2013-08-27
* ==================================================================
*/
function insert_friends($user_id1, $user_id2) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "INSERT INTO friends (user_id1, user_id2)
				VALUES (?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		// Keep smaller number on the left side
		if ($user_id2 < $user_id1) {
			$tmp_id = $user_id2;
			$user_id2=$user_id1;
			$user_id1=$tmp_id;
		}
		$stmt->bind_param("ii", $user_id1, $user_id2);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting friends, user ids: " . $user_id1  . " " . $user_id2;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 *  Signature  : ($user_id1, $user_id2) -> array($errArr)
* Description: Delete a freiend of the user_id1; firend is: user_id2
* * Author: Lev O
* Date  : 2013-08-27
* ==================================================================
*/
function delete_friends($user_id1, $user_id2) {
	global $cxn;

    $errArr=init_errArr(__FUNCTION__); 
   	try
	{
		// Sql String
		$sqlString = "DELETE FROM friends
				WHERE user_id1 = ? AND
				user_id2 = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		// Keep smaller number on the left side
		if ($user_id2 < $user_id1) {
			$tmp_id = $user_id2;
			$user_id2=$user_id1;
			$user_id1=$tmp_id;
		}
		$stmt->bind_param("ii", $user_id1, $user_id2);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting friends, user ids: " . $user_id1  . " " . $user_id2;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 * Manage events
* ==================================================================
*/

/*
 *  ==================================================================
 *  Signature  : [($event_id=SELECT_ALL_EVENTS, $sdate_time=MIN_DATE_TIME, $edate_time=MAX_DATE_TIME,
 *		$date_time_option=SELECT_DT_BOTH, $privacy=PRIVACY_ALL, $tag_name=NULL)] -> (array($errArr, array($ret_events))
 *
 * Description: Select all events including detail information
 * Author: Lev O
 * Date  : 2013-09-10
 * ==================================================================
 * 
*/
function fetch_events($event_id=SELECT_ALL_EVENTS, $sdate_time=MIN_DATE_TIME, $edate_time=MAX_DATE_TIME,
		$date_time_option=SELECT_DT_BOTH, $privacy=PRIVACY_ALL, $tag_name=NULL) {
	global $cxn;
	// Initialize variables
	$ret_events= NULL;
	
	$errArr=init_errArr(__FUNCTION__);
	try {
		// initialize variables
		$where        = ZERO_LENGTH_STRING;
		$param_types  = ZERO_LENGTH_STRING;
		$param_values = array();
		$sql_and      = " "; 
		// Set up event id selection
		if ($event_id != NULL AND $event_id != SELECT_ALL_EVENTS) {
			$where = $where . $sql_and . " eID = ? ";
			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
			$param_types      = $param_types . "i";   // add parameter type
			$param_values []  = $event_id;            // add parameter value
		}
		// Set up date and time selection
		if (($sdate_time != NULL AND $sdate_time != MIN_DATE_TIME) OR
				($edate_time != NULL AND $edate_time != MAX_DATE_TIME)) {
			// Check and set up if need to compare both (start and end time) or just start or end time
			// Set up Start date
			if ($date_time_option == SELECT_DT_START) {
				$where = $where . $sql_and .
				" (sdate_time BETWEEN ? AND ? ) ";
				$param_types      = $param_types . "ss";                                 // add parameter type
				array_push($param_values, $sdate_time, $edate_time);                     // add parameter value
			}
			else {
				// Set up end date
				if ($date_time_option == SELECT_DT_END) {
					$where = $where . $sql_and .
					" (edate_time BETWEEN ? AND ? ) ";
					$param_types      = $param_types . "ss";                                 // add parameter type
					array_push($param_values, $sdate_time, $edate_time);                     // add parameter value
				}
				else {
					$where = $where . $sql_and .
					" ( (sdate_time BETWEEN ? AND ? )"
							. " OR " .
							"   (edate_time BETWEEN ? AND ? ) )";
					$param_types      = $param_types . "ssss";                                    // add parameter type
					array_push($param_values,$sdate_time, $edate_time, $sdate_time, $edate_time); // add parameter value
				}
			}
			$sql_and          = " AND ";                                                 // set up "AND" value tobe used in following settings
		}
		
		// Set up privacy 
		if ($privacy != NULL AND $privacy != PRIVACY_ALL) {
			$where = $where . $sql_and . " privacy = ? ";
			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $privacy;            // add parameter value
		}
		//
		//
		if ($tag_name != NULL) {
			$where = $where . $sql_and . " ( tag_1=? OR tag_2=? OR tag_3=? OR tag_4=? OR tag_5=? OR tag_6=? ) ";
			$sql_and          = " AND ";                   // set up "AND" value tobe used in following settings
			$i = 0;
			do {
				$param_types      = $param_types . "s" ;       // add parameter type
				$param_values []  = $tag_name;                 // add parameter value
				$i++;
			} while ($i < 6);
		}
		// Add WHERE keyword
		if (trim($where) !== ZERO_LENGTH_STRING) {
			$where = " WHERE " . $where;
		}
		// build sqlstring 
		$sqlString = 
		        "SELECT * FROM events_all_v "
		        		. $where .
		         " ORDER BY sdate_time, edate_time, eID";
		// prepare statement
		$stmt = $cxn->prepare($sqlString);
				
		// bind parameters
		// Create array of types and their values
		$params=array_merge( array($param_types), $param_values);
		
		if (count($param_values) > 0) {
			call_user_func_array ( array($stmt, "bind_param"), ref_values($params) );
		}
		// execute statement
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$ret_events[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting events, event id: " . $event_id .
		" Date time: " . $start_date_time . " " . $end_date_time .
		" Date time option: " .  $date_time_option . " privacy: " . $privacy;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $ret_events);
}

/* ==================================================================
 *  Signature  : ($parent_event_id) -> array($errArr, array($events)
 *  
 * Description: Select all child events using parent event id
 * Author: Lev O
 * Date  : 2013-10-19
 * ==================================================================
 */
function fetch_child_events($parent_event_id) {
	global $cxn;
	// Initialize variables
	$events = NULL;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "SELECT *
				FROM events
				WHERE parent_event_id = ?
				ORDER BY sdate_time, eID ";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("i", $parent_event_id);

		$stmt->execute();

		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$events []=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting events by parent event id: " . $parent_event_id; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $events);
}

// 
// *** Function below is rewritten
//  
// function fetch_events($event_id=SELECT_ALL_EVENTS, $start_date_time=MIN_DATE_TIME, $end_date_time=MAX_DATE_TIME,
// 		$date_time_option=SELECT_DT_BOTH, $privacy=PRIVACY_ALL) {
// 	global $cxn;
// 	// Initialize variables
// 	$ret_events=NULL;
// 	$event=NULL;

// 	$errArr=init_errArr(__FUNCTION__);
// 	try
// 	{
// 		$where =ZERO_LENGTH_STRING;
		
// 		// Set up Privacy selection using passed parameters
// 		if ($event_id <> SELECT_ALL_EVENTS) {
// 			$where = $where . " eId = " . $event_id;
// 		}
// 		// Date time selection
// 		$tmp_string=ZERO_LENGTH_STRING;
		
// 		switch ($date_time_option) {
// 			case SELECT_DT_BOTH:
// 				$tmp_string = " ( (A.sdate_time BETWEEN " . "'" . $start_date_time . "'" . " AND " . "'" .$end_date_time . "'" . ")" 
// 						. " OR " .
// 						" (A.edate_time BETWEEN " . "'" . $start_date_time . "'" . " AND " . "'" .$end_date_time . "'" . ") )" ;
// 				break;
// 			case SELECT_DT_START:
// 				$tmp_string = " (A.sdate_time BETWEEN " . "'" . $start_date_time . "'" . " AND " . "'" .$end_date_time . "'" . ")";
// 				break;
// 			case SELECT_DT_END:
// 				$tmp_string = " (A.edate_time BETWEEN " . "'" . $start_date_time . "'" . " AND " . "'" .$end_date_time . "'" . ")";
// 				break;
// 			default:
// 				break;		
// 		}
// 		if (trim($tmp_string !== ZERO_LENGTH_STRING) AND trim($where !== ZERO_LENGTH_STRING)) {
// 			$where = $where . " AND ";
// 		}
// 		$where = $where . $tmp_string;

// 		$tmp_string = ZERO_LENGTH_STRING;
// 		if ($privacy === PRIVACY_PUBLIC or $privacy === PRIVACY_PRIVATE) {
// 			$tmp_string = " privacy = " . "'" . $privacy . "'";
// 		}
// 		if (trim($tmp_string !== ZERO_LENGTH_STRING) AND trim($where !== ZERO_LENGTH_STRING)) {
// 			$where = $where . " AND ";
// 		}
// 		$where = $where . $tmp_string;
// 		if (trim($where) !== ZERO_LENGTH_STRING) {
// 			$where = " WHERE " . $where;
// 		}
		
// 		// SQL String
// 		$sqlString =
// 		    "SELECT eID, A.eventName, A.location, A.genre,
// 		            A.url, A.sdate_time, A.edate_time, A.privacy, A.event_descr, A.event_status,
// 		    		A.addr_id
// 		     FROM events A"
// 		      . $where .
// 		     " UNION " .
// 		     "SELECT eID, events.eventName, events.location, events.genre,
// 		        	 events.url, A.sdate_time, A.edate_time, events.privacy, events.event_descr, events.event_status,
// 		     		 events.addr_id
// 		      FROM events JOIN repeat_events A ON
// 				   events.eId = A.event_id "
// 		      . $where .
// 		      " ORDER BY sdate_time, edate_time,eID";
		
// 			  // Bind variables
// 				$stmt = $cxn->prepare($sqlString);
// 				$stmt->execute();
// 				// Store result
// 				/* Bind results to variables */
// 				bind_array($stmt, $row);
// 				while ($stmt->fetch()) {
// 					$ret_events[]=cvt_to_key_values($row);
// 				}
// 	}
// 	catch (mysqli_sql_exception	$err)
// 	{
// 		// Error settings
// 		$err_code=1;
// 		$err_descr="Error selecting events, event id: " . $event_id . 
// 		      " Date time: " . $start_date_time . " " . $end_date_time .  
// 		      " Date time option: " .  $date_time_option . " privacy: " . $privacy; 
// 		set_errArr($err, $err_code, $err_descr, $errArr);
// 	}
// 	// Return Error code
// 	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
// 	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
// 	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
// 	return array($errArr, $ret_events);
// }

/*
 *  ==================================================================
*  Signature  : ($sdate_time=MIN_DATE_TIME, $edate_time=MAX_DATE_TIME, 
		       $eventName=NULL,    $location=NULL,     $genres=NULL,       $privacy=NULL,       $event_status=NULL,
		       $tag_name=NULL,
		       $role_ids=NULL,     $country_code=NULL, $city=NULL,         $province_code=NULL, $street_name=NULL,
		       $postal_code=NULL,  $latitude=NULL,     $longitude=NULL,    $distance_km=NULL,   $fetch_top_n=NULL) 
*                            ->($errArr, $ret_events);
* Description: Select all events including repeating events, roles and addresses
* Author: Lev O
* Date  : 2013-10-01
* ==================================================================
*/
function fetch_top_events($sdate_time=MIN_DATE_TIME, $edate_time=MAX_DATE_TIME, 
		       $eventName=NULL,    $location=NULL,     $genres=NULL,       $privacy=NULL,       $event_status=NULL,
		       $tag_name=NULL,
		       $role_ids=NULL,     $country_code=NULL, $city=NULL,         $province_code=NULL, $street_name=NULL,
		       $postal_code=NULL,  $latitude=NULL,     $longitude=NULL,    $distance_km=NULL,   $fetch_top_n=NULL) {
	global $cxn;
	// Initialize variables
	$ret_events=NULL;
	$tmp_events="tmp_events";                 // Name of Temporary table
	
	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Set up date and time selection 
		$where =  " ( (sdate_time BETWEEN ? AND ? )"
				. " OR " .
			   	  "   (edate_time BETWEEN ? AND ? ) )";
			   	
		// Initialize parameter types and parameter values
		$param_types  = "ssss";
		$param_values = array($sdate_time, $edate_time, $sdate_time, $edate_time); 
		
		// Set up where condtions and parameters for the second part of the query
		//   - we need this because of repeating events
		$where_1        = $where;
		$param_types_1  = $param_types;
		$param_values_1 = $param_values; 
				              
		// set up event name selection
		if ($eventName != NULL) {
			$where = $where . " AND eventName = ? ";
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $eventName;           // add parameter value
		}
		// set up location selection
		if ($location != NULL) {
			$where = $where . " AND location = ? ";
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $location;            // add parameter value
		}
		// set up genre selection
		if ($genres != NULL and count($genres) > 0) {
			$where = $where . " AND genre IN (";
			$first_element=TRUE;
			foreach ($genres as $g) {
				if ($first_element) {
					$first_element = FALSE;
					$comma = "";
				}
				else {
					$comma = ",";
				}
				$where = $where . $comma . "?";
				$param_types      = $param_types . "s";   // add parameter type
				$param_values []  = $g;                   // add parameter value
			}
			$where = $where . ")";
		}
		// set up privacy 
		if ($privacy != NULL) {
			$where = $where . " AND privacy = ?";
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $privacy;             // add parameter value
		}
		// set up event status
		if ($event_status != NULL) {
			$where = $where . " AND event_status = ?";
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $event_status;        // add parameter value
		}
		// set up tag selection
		//
		if ($tag_name != NULL) {
			$where = $where . " AND ( tag_1=? OR tag_2=? OR tag_3=? OR tag_4=? OR tag_5=? OR tag_6=? ) ";
			$i = 0;
			do {
				$param_types      = $param_types . "s" ;       // add parameter type
				$param_values []  = $tag_name;                 // add parameter value
				$i++;
			} while ($i < 6);
		}
		// set up Role selection
		if ($role_ids != NULL and count($role_ids) > 0) {
			$where = $where . " AND role_id IN (";
			$first_element=TRUE;
			foreach ($role_ids as $rid) {
				if ($first_element) {
					$first_element = FALSE;
					$comma = "";
				}
				else {
					$comma = ",";
				}
				$where = $where . $comma . "?";
				$param_types      = $param_types . "i";   // add parameter type
				$param_values []  = $rid;                 // add parameter value
			}
			$where = $where . ")";
		}
		// set up country selection
		if ($country_code != NULL) {
			$where = $where . " AND country_code = ? ";
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $country_code;        // add parameter value 
		}
		// set up province selection
		if ($province_code != NULL) {
			$where = $where . " AND province_code = ? "; 
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $province_code;       // add parameter value
		}
		// set up city selection
		if ($city != NULL) {
			$where = $where . " AND city = ? "; 
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $city;                // add parameter value
		}
		// set up street name 
		if ($street_name != NULL) {
			$where = $where . " AND street_name = ? "; 
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $street_name;         // add parameter value
		}
		// set up postal code 
		if ($postal_code != NULL) {
			$where = $where . " AND postal_code = ? "; 
			$param_types      = $param_types . "s";   // add parameter type
			$param_values []  = $postal_code;         // add parameter value
			
		}
		// Add WHERE keyword		
		if (trim($where) !== ZERO_LENGTH_STRING) {
			$where = " WHERE " . $where;
		}

		// limit result
		$limit_str = "";
		if ($fetch_top_n != NULL) {
			$limit_str =  " limit " . $fetch_top_n;
		}
		// SQL String
		$sqlString =
		    "CREATE TEMPORARY TABLE IF NOT EXISTS "
		    . $tmp_events .		
		     " AS (SELECT eId, count(user_id) AS num_users
		     FROM events_address_users_v " 
		     . $where 
		     . " GROUP BY eId "
		     . " ORDER BY num_users DESC "
		     . $limit_str . ")"; 
			 	
       	$stmt0 = $cxn->prepare($sqlString);
		// bind parameters 
		// Create array of types and their values
		$params=array_merge( array($param_types), $param_values);
		
		// print_r($params);
		
		call_user_func_array ( array($stmt0, "bind_param"), ref_values($params) );
		$stmt0->execute();
		// ---------------------------------------
		//  Now return data from temporary table
		// --------------------------------------
		// Add WHERE keyword
		if (trim($where_1) !== ZERO_LENGTH_STRING) {
			$where_1 = " WHERE " . $where_1;
		}
		$sqlString = "SELECT A.* , B.num_users
				 FROM events_address_v A
				 JOIN tmp_events B ON
				      A.eId=B.eId "
				 . $where_1 .
				 " ORDER BY B.num_users DESC "; 
		
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		// bind parameters 
		$params_1=array_merge( array($param_types_1), $param_values_1);
		call_user_func_array ( array($stmt, "bind_param"), ref_values($params_1) );
		$stmt->execute();
		// select all necessary data of the corresponding events 
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$ret_events[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting events, address, roles: " . 
		" Date time: " . $sdate_time . " " . $edate_time .
		 " " . $eventName . " " . $location . " " . $genres . " " . $event_status . " " . 
		 " " . $tag_name . " " . $role_ids . 
		 " " . $country_code . " " . $city . " " . $province_code . " " . $street_name . " " . $postal_code . 
		 " " . $latitude . " " . $longitude . " " . $distance_km . " " . $fetch_top_n ; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Clean-up
	$errArr_1 = drop_temp_table($tmp_events);
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $ret_events);
}

/* 
 * ==================================================================
 *  Signature  : ($eventName, $location, $genre, $url, $sdate_time, $edate_time, $privacy, $event_descr=STRING_LENGTH_0,
 *         $event_status=STATUS_ACTIVE, $addr_id=NULL, $parent_event_id=NULL,
 *         $tag_1=NULL, $tag_2=NULL, $tag_3=NULL, $tag_4=NULL, $tag_5=NULL, $tag_6=NULL) -> $errArr
 *   
 * Description: Insert record into events DB table
 * Author: Lev O
 * Date  : 2013-09-02
 * ==================================================================
*/

function insert_events($eventName, $location, $genre, $url, $sdate_time, $edate_time, $privacy, 
		               $event_descr=STRING_LENGTH_0, $event_status=STATUS_ACTIVE, $addr_id=NULL, $parent_event_id=NULL,
		               $tag_1=NULL, $tag_2=NULL, $tag_3=NULL, $tag_4=NULL, $tag_5=NULL, $tag_6=NULL)  {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "INSERT INTO events
				 (eventName, location, genre, url, sdate_time, edate_time, privacy, event_descr, event_status, 
				  addr_id, parent_event_id, tag_1, tag_2, tag_3, tag_4, tag_5, tag_6)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,  ?, ?, ?,  ?, ?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("sssssssssiissssss", $eventName, $location, $genre, $url, $sdate_time, $edate_time, $privacy,
				                       $event_descr, $event_status, $addr_id, $parent_event_id,
				          $tag_1, $tag_2, $tag_3, $tag_4, $tag_5, $tag_6 );
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting events, event name: " . $eventName  . " location: " . $location . 
		            " gendre: " . $genre . " url: " . $url . " start date time: " .  $sdate_time . 
		            " end date time: " . $edate_time . " privacy: " . $privacy . " descr: " . $event_descr . 
		            " status: " . $event_status . " addr: " . $addr_id . " " . $parent_event_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	$errArr[ERR_INSERT_ID]     = $cxn->insert_id;
	return $errArr;
}

/*
 *  ==================================================================
*  Signature  : ($event_id) -> array($errArr)
* Description: Delete an event from events table 
* Author: Lev O
* Date  : 2013-09-03
* ==================================================================
*/
function delete_events($event_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "DELETE FROM events
				WHERE eID = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("i", $event_id);
		$stmt->execute();
		
		// Check and delete users from this event
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting events , event id: " . $event_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	if ($errArr[ERR_AFFECTED_ROWS]==0) { 
	    $errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	}
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/*
 *  ==================================================================
*  Signature  : ($parent_event_id) -> array($errArr)
* Description: Delete an event from events table by parent event id
* Author: Lev O
* Date  : 2013-10-14
* ==================================================================
*/
function delete_events_by_parent_id($parent_event_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "DELETE FROM events
				WHERE parent_event_id = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("i", $parent_event_id);
		$stmt->execute();

		// Check and delete users from this event
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting events , parent event id: " . $parent_event_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	if ($errArr[ERR_AFFECTED_ROWS]==0) {
		$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	}
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/*
 *  ==================================================================
 * Signature  : ($eID, $set_arr) -> $errArray 
 *     $set_arr is array of key-values where keys are column names and value is value
 *               the appropriate column has to be set up to passed value.
 *               
 * Description: Update any column of the events table
 * 
 * Tip        : if $eID is = NULL then all records in the table will be updated (it could be dangerous!).           
 * Author: Lev O
 * Date  : 2013-10-21
 * ==================================================================
 */
function update_events ($eID, &$set_arr) {
	// Initialize variables
	$errArr=init_errArr(__FUNCTION__);
	// Construct passing parameters 
	$table_name       = "events";
	$key_arr          = array();
	$key_1            = "eID";                     // this is key column from events table
	$key_arr [$key_1] = $eID;                      // set up value to the key
	
	// call the universal function to do the update
	$errArr = update_any_table($table_name, $key_arr, $set_arr) ;
		
	return $errArr;
}

/*
 *  ==================================================================
* Signature  : ($table_name, $key_arr, $set_arr) -> $errArray
*     $set_arr is array of key-values where keys are column names and value is value
*               the appropriate column has to be set up to passed value.
*     $key_arr is array of keys to be used to construct "WHERE" condition.
*               
* Description: Update any column of any table
*
* Author: Lev O
* Date  : 2013-10-21
* ==================================================================
*/
function update_any_table ($table_name, $key_arr, $set_arr) {
	global $cxn;
	// Initialize variables
	$errArr=init_errArr(__FUNCTION__);
    //
	$tmp_error    = FALSE;
	// Validate Input parameters and return error if validation fail
	if (count($set_arr) == 0) {                            // array with set values is empty
		$tmp_error = TRUE;
		$err_code  = 1;
		$err_descr = "Passed parameter set_arr is empty for the table: " . $table_name;
		$err       = NULL;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	elseif (trim($table_name) == ZERO_LENGTH_STRING){     // check if table name is not empty string
		$tmp_error = TRUE;
		$err_code  = 2;
		$err_descr = "Passed table name is empty string: " . $table_name;
		$err       = NULL;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	else {
		// Main validation passed, start constracting sql statement
		$set_string   = ZERO_LENGTH_STRING;
		$where_string = ZERO_LENGTH_STRING;
		$comma        = ZERO_LENGTH_STRING;
		//
		$param_types  = ZERO_LENGTH_STRING;
		$param_values = array();
		//
		foreach ($set_arr as $key => $value) {
			if (get_column_type($table_name, $key) == NULL) {
				$tmp_error = TRUE;
				// Set up error: column name is not in the table
				$err_code  = 3;
				$err_descr = "Column name: " . $key . " is not in the table: " . $table_name;
				$err       = NULL;
				set_errArr($err, $err_code, $err_descr, $errArr);
			}
			else {
				$set_string = $set_string . $comma . $key . "= ? " ;             // update the set_string
				$param_types      = $param_types . get_bind_parm_type($value);   // add parameter type
				$param_values []  = $value;                                      // add parameter value
				// set up comma to it's value for the next iteration
				if ($comma == ZERO_LENGTH_STRING) {
					$comma = ",";
				}
			}
		}
		// Continue, if there is no error
		if (!$tmp_error) {
			// Add SET to the statement
			$set_string = " SET "
					. $set_string;
            // 
            // Build WHERE condition
            //
			$sql_and      = " ";
			foreach ($key_arr as $key => $value) {
				if ($value != NULL) {
					$where_string = $where_string . $sql_and . $key . "= ? " ;      // update the set_string
					$param_types      = $param_types . get_bind_parm_type($value);  // add parameter type
					$param_values []  = $value;                                     // add parameter value
					// set up AND value for the next iteration
					$sql_and          = " AND ";
				}
			}
			if (trim($where_string) != ZERO_LENGTH_STRING) {
				$where_string = " WHERE " . $where_string;
			}
			// Check the error and continue
			if (!$tmp_error) {
				try {
					// create sqlString
					$sqlString = "UPDATE " . $table_name . " "
							. $set_string
							. $where_string;
					
					$stmt   = $cxn->prepare($sqlString);
					// Create array of types and their values
					$params = array_merge(array($param_types), $param_values);
					// Debug - start
					// echo "\n Params: " ;
					// print_r ($params);
					// echo "\n Sql string: " . $sqlString; 
					// Debug - end
					if (count($param_values) > 0) {
						call_user_func_array ( array($stmt, "bind_param"), ref_values($params) );
					}
					$stmt->execute();
				}
				catch (mysqli_sql_exception $err) {
					// Error settings
					$err_code  = 5;
					$err_descr = "Error updating table: " . $table_name . " keys: " . 
							http_build_query($key_arr, '', ', ')
							. " values: "
							. http_build_query($set_arr, '', ', ') ;
					set_errArr($err, $err_code, $err_descr, $errArr);
				}
				// Return Error code
				$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
				$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
				$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
			}
		}
	}
	return $errArr;
}
	
	//
	//
	//
	
	
// 			echo "\n Sql string: \n " . $sqlString . " \n";
// 			// Return Error code
// 			$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
// 			$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
// 			$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
// 		}
// 	}

// 	return $errArr;
// }
	//
	//
	//
	
// 	try
// 	{
// 		// initialize variables
// 		$where        = ZERO_LENGTH_STRING;
// 		$param_types  = ZERO_LENGTH_STRING;
// 		$param_values = array();
// 		$sql_and      = " ";
// 		// Set email selection
// 		if ($pass_email != NULL) {
// 			$where = $where . $sql_and . " email = ? ";
// 			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
// 			$param_types      = $param_types . "s" ;  // add parameter type
// 			$param_values []  = $pass_email;          // add parameter value
// 		}
// 		// Set up date and time selection
// 		if ($sdate_time != MIN_DATE_TIME OR $edate_time != MAX_DATE_TIME) {
// 			$where =  $where . $sql_and .
// 			" ( (sdate_time BETWEEN ? AND ? )"
// 					. " OR " .
// 					"   (edate_time BETWEEN ? AND ? ) )";
// 			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
// 			// Initialize parameter types and parameter values
// 			$param_types  = $param_types . "ssss";
// 			array_push($param_values, $sdate_time, $edate_time, $sdate_time, $edate_time);
// 		}
// 		// set up privacy
// 		if ($privacy != NULL) {
// 			$where = $where . $sql_and . " privacy = ?";
// 			$sql_and          = " AND ";              // set up "AND" value tobe used in following settings
// 			$param_types      = $param_types . "s";   // add parameter type
// 			$param_values []  = $privacy;             // add parameter value
// 		}
// 		// set up Role selection
// 		if ($role_ids != NULL and count($role_ids) > 0) {
// 			$where = $where . $sql_and . " role_id IN (";
// 			$first_element=TRUE;
// 			foreach ($role_ids as $rid) {
// 				if ($first_element) {
// 					$first_element = FALSE;
// 					$comma = "";
// 				}
// 				else {
// 					$comma = ",";
// 				}
// 				$where = $where . $comma . "?";
// 				$param_types      = $param_types . "i";   // add parameter type
// 				$param_values []  = $rid;                 // add parameter value
// 			}
// 			$where = $where . ")";
// 			$sql_and          = " AND ";                 // set up "AND" value tobe used in following settings
// 		}

// 		// Add WHERE keyword
// 		if (trim($where) !== ZERO_LENGTH_STRING) {
// 			$where = " WHERE " . $where;
// 		}

// 		// SQL String
// 		$sqlString = "SELECT * "
// 				. " FROM users_events_dtl_v "
// 						. $where .
// 						" ORDER BY sdate_time, eID";
			
// 		$stmt = $cxn->prepare($sqlString);
// 		// bind parameters
// 		// Create array of types and their values
// 		$params=array_merge( array($param_types), $param_values);
// 		echo "\n" . $sqlString . "\n";

// 		if (count($param_values) > 0) {
// 			call_user_func_array ( array($stmt, "bind_param"), ref_values($params) );
// 		}
// 		$stmt->execute();
// 		// Store result
// 		/* Bind results to variables */
// 		bind_array($stmt, $row);
// 		while ($stmt->fetch()) {
// 			$ret_events[]=cvt_to_key_values($row);
// 		}
// 	}
// 	catch (mysqli_sql_exception	$err)
// 	{
// 		// Error settings
// 		$err_code  = 1;
// 		$err_descr = "Error selecting user events for the email: " . $pass_email . " " .
// 				$sdate_time . " " .  $edate_time . " " .
// 				$privacy . " " . $role_ids;
// 		set_errArr($err, $err_code, $err_descr, $errArr);
// 	}
// 	// Return Error code
// 	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
// 	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
// 	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
// 	return array($errArr, $ret_events);
// }


/* ==================================================================
 * Manage role descriptions
* ==================================================================
*/
/*
*  ==================================================================
* Signature  : (int $role_id = NULL ) -> (array($errArr, array($roles)
* Description: Select all roles and their descriptions or select just one role and 
*     description.
* Author: Lev O
* Date  : 2013-09-05
* ==================================================================
*/
function fetch_role_descr ($role_id = NULL) {
	global $cxn;
	// Initialize variables
	$roles = NULL;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		$where = ZERO_LENGTH_STRING; 
		// Set up WHERE condition depending on passed parameters
		if ($role_id != NULL) {
			$where = " WHERE role_id = ? ";
		}
		// Sql String
		$sqlString = "SELECT *
					  FROM role_descr " 
				     . $where . 
					 " ORDER BY role_id  ";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		
		IF ($role_id != NULL) {	
			$stmt->bind_param("i", $role_id);
		}
		
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$roles[]=cvt_to_key_values($row);
		}
		
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting from friends, users  with user_id: " . $user_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $roles);
}

/* ==================================================================
 *  Signature  : (int $role_id, $role_descr) -> array($errArr)
* Description: Insert record into role descripion table
* Author: Lev O
* Date  : 2013-08-27
* ==================================================================
*/
function insert_role_descr($role_id, $role_descr) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "INSERT INTO role_descr (role_id, role_descr) 
				VALUES (?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		
		$stmt->bind_param("is", $role_id, $role_descr );
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting role description, role: " . $role_id  . " " . $role_descr ;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 *  Signature  : (int $role_id) -> array($errArr)
* Description: Delete a role from  role description table 
* Author: Lev O
* Date  : 2013-09-05
* ==================================================================
*/
function delete_role_descr($role_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Sql String
		$sqlString = "DELETE FROM role_descr
				WHERE role_id = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		
		$stmt->bind_param("i", $role_id );
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting role_descr, role ids: " . $role_id ; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 * Manage repeat events
* ==================================================================
*/

/*
 *  ==================================================================
* Signature  : (int $event_id [,$sdate_time=MIN_DATE_TIME [,$fetch_option=FETCH_ALL |FETCH_ONE ]])
*                      -> (array($errArr, array($repeat_events))
* Description: Select repeat events for the provided event_id and Optional start date time
*     and fetch option (All or One). 
* Author: Lev O
* Date  : 2013-09-07
* ==================================================================
*/
function fetch_repeat_events ($event_id, $sdate_time=MIN_DATE_TIME, $fetch_option=FETCH_ALL) {
	global $cxn;
	// Initialize variables
	$repeat_events = NULL;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Set up WHERE condition depending on passed parameters
		if ($fetch_option==FETCH_ALL) {
			$where = " AND sdate_time >= ? ";
		}
		else {
			$where = " AND sdate_time = ? ";
		}
		// Sql String
		$sqlString = "SELECT *
					  FROM repeat_events
				      WHERE event_id = ?"
			     	. $where .
			    	" ORDER BY sdate_time  ";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("is", $event_id, $sdate_time);
		
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$repeat_events[]=cvt_to_key_values($row);
		}

	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting from repeat_events, event_id: " . $event_id . "start date_time: "
				 .$sdate_time . " fetch option: " . $fetch_option; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $repeat_events);
}
/*
* ==================================================================
*  Signature  : ($event_id, $sdate_time, $edate_time) -> $errArr
*
* Description: Insert record into repeat_events table
* Author: Lev O
* Date  : 2013-09-07
* ==================================================================
*/

function insert_repeat_events($event_id, $sdate_time, $edate_time)  {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "INSERT INTO repeat_events
				 (event_id, sdate_time, edate_time)
				VALUES (?, ?, ? )";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("iss",  $event_id, $sdate_time, $edate_time );
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting repeat_events, event id: " . $event_id  . 
		    " start date time: " .  $sdate_time .
	    	" end date time: " . $edate_time; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 *  Signature  : (int $event_id [,$sdate_time=MIN_DATE_TIME, $delete_option=DELETE_ALL]) -> array($errArr)
* Description: Delete event by event id and optionally by Date Time from repeat_events table 
* Author: Lev O
* Date  : 2013-09-07
* ==================================================================
*/
function delete_repeat_events ($event_id, $sdate_time=MIN_DATE_TIME, $delete_option=DELETE_ALL) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__); 
	try
	{
		// Set up delete conditions 
		if ($delete_option == DELETE_ONE) {
			$where = " AND sdate_time = ?";
		}
		else {
			$where = " ";
		}
		// Sql String
		$sqlString = "DELETE FROM repeat_events 
				WHERE event_id = ?" 
		       . $where  ;
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		if ($delete_option == DELETE_ONE) {
		    $stmt->bind_param("is", $event_id, $sdate_time );
		}
		else {
			$stmt->bind_param("i", $event_id );
		}
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code = 1;
		$err_descr = "Error deleting repeat_events, event id: " . $event_id . " sdate_time: " . $sdate_time
		               . " delete_option: " . $delete_option ;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/*
 *  ==================================================================
* Signature  : ($frq [,$fetch_option=FETCH_ALL |FETCH_ONE ])
*                      -> (array($errArr, array($frq_choice_descriptions))
* Description: frequncy descriptions 
* Author: Lev O
* Date  : 2013-09-09
* ==================================================================
*/
function fetch_frq_choice_descr ($frq, $fetch_option=FETCH_ALL) {
	global $cxn;
	// Initialize variables
	$frq_choice_descr = NULL;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Set up WHERE condition depending on passed parameters
		if ($fetch_option==FETCH_ALL) {
			$where = " ";
		}
		else {
			$where = " WHERE frq = " . "'"  . $frq . "'" ;
		}
		// Sql String
		$sqlString = "SELECT *
					  FROM frq_choice_descr "
				      . $where .
			     	" ORDER BY frq ";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$frq_choice_descr[]=cvt_to_key_values($row);
		}

	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting from frq_choice_descr, frq: " . $frq . " fetch option: " . $fetch_option;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $frq_choice_descr);
}
/*
 * ==================================================================
*  Signature  : ($frq, $frq_descr) -> $errArr
*
* Description: Insert record into frq_choice_descr table
* Author: Lev O
* Date  : 2013-09-09
* ==================================================================
*/

function insert_frq_choice_descr ($frq, $frq_descr)  {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "INSERT INTO frq_choice_descr (frq, frq_descr)
				VALUES (?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("ss",  $frq, $frq_descr); 
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting frq_choice_descr, frq: " . $frq  . " frq_descr: " .  $frq_descr; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 *  Signature  : (char $frq) -> array($errArr)
* Description: Delete frequency description 
* Author: Lev O
* Date  : 2013-09-09
* ==================================================================
*/
function delete_frq_choice_descr ($frq) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		$sqlString = "DELETE FROM frq_choice_descr 
		      		  WHERE frq = ?";
					
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("s", $frq); 
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code = 1;
		$err_descr = "Error deleting frq_choice_descr, frq: " . $frq; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}


/*
 * ==================================================================
* Signature  : ($frq, $set_arr) -> $errArray
*     $set_arr is array of key-values where keys are column names and value is value
*               the appropriate column has to be set up to passed value.
*
* Description: Update any column of the frq_choice_descr table
*
* Tip        : if $frq is = NULL then all records in the table will be updated (it could be dangerous!).
* Author: Lev O
* Date  : 2013-10-27
* ==================================================================
*/
function update_frq_choice_descr ($frq, &$set_arr) {
	// Initialize variables
	$errArr=init_errArr(__FUNCTION__);
	// Construct passing parameters
	$table_name       = "frq_choice_descr";
	$key_arr          = array();
	$key_1            = "frq";                     // this is key column from events table
	$key_arr [$key_1] = $frq;                      // set up value to the key

	// call the universal function to do the update
	$errArr = update_any_table($table_name, $key_arr, $set_arr) ;

	return $errArr;
}
/*
 *  ==================================================================
* Signature  : (int $event_id)
*                      -> (array($errArr, array($repeat_events_frq_choice) )
* Description: select repeat_events_frq_choice  
* Author: Lev O
* Date  : 2013-09-09
* ==================================================================
*/
function fetch_repeat_events_frq_choice ($event_id) {
	global $cxn;
	// Initialize variables
	$repeat_events_frq_choice = NULL;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "SELECT *
					  FROM repeat_events_frq_choice 
				      WHERE event_id = ?";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("i",  $event_id);  
		$stmt->execute();
		
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$repeat_events_frq_choice[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting from fetch_repeat_events_frq_choice, event_id " . $event_id; 
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $repeat_events_frq_choice);
}
/*
 * ==================================================================
*  Signature  : ($event_id, $frq, $rpt_events_start, $rpt_events_end ) -> $errArr
*
* Description: Insert record into fetch_repeat_events_frq_choice table
* Author: Lev O
* Date  : 2013-09-09
* ==================================================================
*/

function insert_repeat_events_frq_choice ($event_id, $frq, $rpt_events_start, $rpt_events_end)  {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "INSERT INTO repeat_events_frq_choice (event_id, frq, rpt_events_start, rpt_events_end)
				VALUES (?, ?, ?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("isss", $event_id, $frq, $rpt_events_start, $rpt_events_end);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting repeat_events_frq_choice, event_id: " . $event_id 
		          . " frq: " . $frq . " date time: " . $rpt_events_start . " " . $rpt_events_end;
		          
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 *  Signature  : (char $frq) -> array($errArr)
* Description: Delete frequency description
* Author: Lev O
* Date  : 2013-09-09
* ==================================================================
*/
function delete_repeat_events_frq_choice ($event_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		$sqlString = "DELETE FROM repeat_events_frq_choice
		      		  WHERE event_id = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->bind_param("i", $event_id);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code = 1;
		$err_descr = "Error deleting repeat_events_frq_choice: " . $event_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
 * Manage address
* ==================================================================
*/

/*
 *  ==================================================================
*  Signature  : ([$event_id=NULL])-> (array($errArr, array($addresses))
*
* Description: Select all addresses /specific address from address table
* Author: Lev O
* Date  : 2013-09-29
* ==================================================================
*/
function fetch_address($addr_id=NULL ) {
	global $cxn;
	// Initialize variables
	$addresses=NULL;
	
	$errArr=init_errArr(__FUNCTION__);
	try
	{
		$where =ZERO_LENGTH_STRING;

		// Set up address id selection
		if ($addr_id != NULL) {
			$where = $where . " addr_id = " . $addr_id;
		}
		
		if (trim($where) !== ZERO_LENGTH_STRING) {
			$where = " WHERE " . $where;
		}

		// SQL String
		$sqlString =
		   "SELECT *
		    FROM address " 
				. $where . 
				" ORDER BY addr_id"; 

		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->execute();
		// Store result
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$addresses[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception	$err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error selecting address id: " . $addr_id;
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $addresses);
}

/*
 * ==================================================================
*  Signature  : ($street_no, $street_name, $street_direct_code, $city, $postal_code, $country_code,
*                $province_code, $misc_addr_line, $addr_tel_no, $addr_email, 
*                $latitude=NULL, $longitude=NULL) -> $errArr
*
* Description: Insert record into address DB table
* Author: Lev O
* Date  : 2013-09-29
* ==================================================================
*/

function insert_address($street_no, $street_name, $street_direct_code, $city, $postal_code, $country_code,
                        $province_code, $misc_addr_line, $addr_tel_no, $addr_email, 
                        $latitude=NULL, $longitude=NULL)  {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "INSERT INTO address
				 (street_no, street_name, street_direct_code, city, postal_code, country_code,
                  province_code, misc_addr_line, addr_tel_no, addr_email, 
                  latitude, longitude) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("isssssssssdd", $street_no, $street_name, $street_direct_code, $city, $postal_code, $country_code,
                        $province_code, $misc_addr_line, $addr_tel_no, $addr_email, 
                        $latitude, $longitude);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error inserting address: " . $street_no . " " . $street_name . " " . $street_direct_code
		           . " " . $city . " " . $postal_code . " " . $country_code . " " 
                   . $province_code . " " .  $misc_addr_line . "tel: " .  $addr_tel_no . " " . $addr_email 
                   . " position: " . $latitude . " " . $longitude;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	$errArr[ERR_INSERT_ID]     = $cxn->insert_id;
	return $errArr;
}

/*
 *  ==================================================================
*  Signature  : ($addr_id) -> array($errArr)
* Description: Delete address from events table.
* Author: Lev O
* Date  : 2013-09-29
* ==================================================================
*/
function delete_address($addr_id) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "DELETE FROM address
				WHERE addr_id = ?";
			
		// Bind variables
		$stmt = $cxn->prepare($sqlString);

		$stmt->bind_param("i", $addr_id);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error deleting address , address id: " . $addr_id;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/*
* ==================================================================
* Signature  : ($addr_id, $set_arr) -> $errArray
*     $set_arr is array of key-values where keys are column names and value is value
*               the appropriate column has to be set up to passed value.
*
* Description: Update any column of the address table
*
* Tip        : if $addr_id is = NULL then all records in the table will be updated (it could be dangerous!).
* Author: Lev O
* Date  : 2013-10-27
* ==================================================================
*/
function update_address ($addr_id, &$set_arr) {
	// Initialize variables
	$errArr=init_errArr(__FUNCTION__);
	// Construct passing parameters
	$table_name       = "address";
	$key_arr          = array();
	$key_1            = "addr_id";                 // this is key column from events table
	$key_arr [$key_1] = $addr_id;                  // set up value to the key

	// call the universal function to do the update
	$errArr = update_any_table($table_name, $key_arr, $set_arr) ;

	return $errArr;
}

/* ==================================================================
 * Help sql funcitons
* ==================================================================
*/
/*
 * ==================================================================
*  Signature  : ($table_name) -> $errArr
* Description : Drop Temporary table 
* Author: Lev O
* Date  : 2013-10-07
* ==================================================================
*/
function drop_temp_table ($table_name) {
	global $cxn;

	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "DROP TEMPORARY TABLE IF EXISTS " .  $cxn->real_escape_string($table_name) ;
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->execute();
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error dropping table: "  . $table_name;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return $errArr;
}

/* ==================================================================
*  Signature  : ($table_name) -> array($errArr, $columns_arr)
*  
* Description : Return result set with column names and column characteristics including Types
* Author: Lev O
* Date  : 2013-10-26
* ==================================================================
*/
function show_columns ($table_name) {
	global $cxn;
	$columns_arr = NULL;
	
	$errArr=init_errArr(__FUNCTION__);
	try
	{
		// Sql String
		$sqlString = "SHOW COLUMNS FROM " . $cxn->real_escape_string($table_name) ;
		// Bind variables
		$stmt = $cxn->prepare($sqlString);
		$stmt->execute();
		/* Bind results to variables */
		bind_array($stmt, $row);
		while ($stmt->fetch()) {
			$columns_arr[]=cvt_to_key_values($row);
		}
	}
	catch (mysqli_sql_exception $err)
	{
		// Error settings
		$err_code=1;
		$err_descr="Error showing columns from table: "  . $table_name;
		set_errArr($err, $err_code, $err_descr, $errArr);
	}
	
	// Return Error code
	$errArr[ERR_AFFECTED_ROWS] = $cxn->affected_rows;
	$errArr[ERR_SQLSTATE]      = $cxn->sqlstate;
	$errArr[ERR_SQLSTATE_MSG]  = $cxn->error;
	return array($errArr, $columns_arr);
}

/*
 * ==================================================================
* Signature   : ($table_name, $column_name) -> $column_row_arr
* Description : Get column characteristics / check if column exists in meta-data 
* Note        : In case column not exists then return NULL
* Author: Lev O
* Date  : 2013-10-26
* ==================================================================
*/
function get_column_type ($table_name, $column_name) { 

	$column_row_arr = NULL;
	
	// Get the array of meta data for the table
	list($errArr, $columns_arr) = show_columns($table_name);
    if ( count($columns_arr) > 0) {
    	// Loop through metadata
    	foreach ($columns_arr as $columns_row)
    	{
    		if ($columns_row[DFT_FIELD] == $column_name) {
    			$column_row_arr = $columns_row;
    			break;              // column name is found in meta data 
    		}
    	}
    }
	return $column_row_arr;
}
/*
 * ==================================================================
* Signature   : ($parm_var) -> $var_bind_type
* Description : Check type of the passed paraameter and return type to be used in prepared statement
* Note        : In case column not exists then return NULL
* Author: Lev O
* Date  : 2013-10-26
* ==================================================================
*/
function get_bind_parm_type (&$parm_var) {

	$bind_parm_type = ZERO_LENGTH_STRING;

	// Set up parameter type for sql bind statement
	if (is_int($parm_var)) {
		$bind_parm_type = "i";
	}
	elseif (is_double($parm_var)) {
		$bind_parm_type = "d";
	}
	elseif (is_string($parm_var)) {
		$bind_parm_type = "s";
	}
	else {
		$bind_parm_type = "b";
	}

	return $bind_parm_type;
}

/*
* ==================================================================
*  Signature  : ($arr) -> array $refs
* Description : Convert to array with key and reference to the values
* Author: Lev O
* Date  : 2013-10-06
* ==================================================================
*/
function ref_values($arr)
{
	$refs = array();

	foreach ($arr as $key => $value)
	{
		$refs[$key] = &$arr[$key];
	}

	return $refs;
}
/*
 * ==================================================================
*  Signature  : associative array ($arr) -> array (values of the passed array)
*   
* Description : Convert associative array (ex.:row) to values and return array of values 
* Author: Lev O
* Date  : 2013-10-15
* ==================================================================
*/
function cvt_arr_to_values($arr)
{
	$result_values = array();

	foreach ($arr as $key => $value)
	{
		$result_values[] = $value;
	}
	// return the values
	return $result_values;
}

/*
// *  ==================================================================
// * Signature  : ($in_array) -> $res_string
// * Description: Convert aray of strings to a string of array elements enclosed in single quote 
// * Note       : resulting string is ready to be used to build "IN" portion of sql statement.
// * Example    : cvt_arr_of_str(array("music","dance") give result a string: 'music','dance'
// * Author: Lev O
// * Date  : 2013-10-03
// * ==================================================================
// */
// function cvt_arr_of_str ($in_array) {
// 	$tmp_str="";
// 	$first_element=TRUE;            // set up flag to indicate first element in array
// 	foreach ($in_array as $in) {
// 		if ($first_element) {
// 			$comma = " ";          // there is no comma before first element so set it to space
// 			$first_element = FALSE;
// 		}
// 		else {
// 			$comma = ",";
// 		}
// 		// note: in below string comma will be equal to space for the first element of the resulting string
// 		$tmp_str = $tmp_str . $comma . "'" . $in . "'";
// 	}
// 	return $tmp_str;
// }

// /*
// *  ==================================================================
// * Signature  : ($in_array) -> $res_string
// * Description: Convert aray of numbers to a string of array elements 
// * Note       : resulting string is ready to be used to build "IN" portion of sql statement.
// * Example    : cvt_arr_of_num(array(3,4)) give result a string: 3,4
// * Author: Lev O
// * Date  : 2013-10-03
// * ==================================================================
// */
// function cvt_arr_of_num ($in_array) {
// 	$tmp_str="";
// 	$first_element=TRUE;            // set up flag to indicate first element in array
// 	foreach ($in_array as $in) {
// 		if ($first_element) {
// 			$comma = " ";          // there is no comma before first element so set it to space
// 			$first_element = FALSE;
// 		}
// 		else {
// 			$comma = ",";
// 		}
// 		// note: in below string comma will be equal to space for the first element of the resulting string
// 		$tmp_str = $tmp_str . $comma . $in ;
// 	}
// 	return $tmp_str;
// }
?>