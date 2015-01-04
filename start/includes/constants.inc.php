<?php
/* ==================================================================
 * Constants for SQL statements and errror handling
 * ==================================================================
 */
define("ERR_CODE", "ERR_CODE");
define("ERR_FUNCTION_NAME", "ERR_FUNCTION_NAME");
define("ERR_DESCR", "ERR_DESCR");
define("ERR_LONG_DESCR", "ERR_LONG_DESCR");
define("ERR_SQLSTATE", "ERR_SQLSTATE");
define("ERR_SQLSTATE_MSG", "ERR_SQLSTATE_MSG");
define("ERR_AFFECTED_ROWS", "ERR_AFFECTED_ROWS");      // Affected rows by last sql statement

define("ERR_INSERT_ID", "ERR_INSERT_ID");      // Affected rows by last sql statement

/* ==================================================================
 * Default timezone
* ==================================================================
*/
define("DFT_TIMEZONE", "ERR_CODE");
define("DFT_DATE_TIME_FORMAT", "Y-m-d H:i:s");
define("DFT_DATE_FORMAT", "Y-m-d");
/* ==================================================================
 * Constants for SQL functions to add flexibility
 */
define("ZERO_LENGTH_STRING", "");
define("STRING_LENGTH_0", "");
define("STRING_LENGTH_1", " ");
//
define("FETCH_ALL", "ALL");
define("FETCH_ONE", "ONE");
define("DELETE_ALL", "ALL");
define("DELETE_ONE", "ONE");
// Repeat event type
define("RPT_EVENT_TYPE_DUPLICATE", "RPT_EVENT_TYPE_DUPLICATE");
define("RPT_EVENT_TYPE_SEPARATE", "RPT_EVENT_TYPE_SEPARATE");
/* ==================================================================
 * Constants for SQL functions to add flexibility
 * Used in fetch_users function
* ==================================================================
*/
define("USERNAME", "username");
define("EMAIL", "email");

/* ==================================================================
 * Constants for SQL functions for Date Time selections
* ==================================================================
*/
define("MIN_DATE_TIME", "0000-00-00 00:00:00");
define("MAX_DATE_TIME", "9999-12-31 23:59:59");

define("SELECT_DT_BOTH", "BOTH");       // Select records where Start or End Date time match 
define("SELECT_DT_START", "START");     // Select records where Start Date time match 
define("SELECT_DT_END", "END");         // Select records where End Date time match 
		
		
/* ==================================================================
 * Constants for roles and user events and events 
* ==================================================================
*/
define("INSERT_DEFAULT_ROLE_ID", 3);      // Default role id at insert time 
define("SELECT_ALL_ROLES",">=0");         // Indicate selection all roles
define("SELECT_ALL_EVENTS", -1);          // Indicate selection all events
define("SELECT_TOP_ALL", "ALL");          // Indicate selection all TOP events

define("DELETE_USER_EVENTS", TRUE);       // Delete user events when event is deleted

define("STATUS_ACTIVE", "Active");       // Status of event = Active 
define("STATUS_CANCEL", "Cancel");       // Status of event = Cancel
define("STATUS_INACTIVE", "Inactive");   // Status of event = Inactive
/* ==================================================================
 * Constants for privacy selection
* ==================================================================
*/
define("DFT_SELECT_PRIVACY", "ALL");      // Default value to be used to select privacy from events
define("PRIVACY_ALL", "ALL");             // All privacies  
define("PRIVACY_PUBLIC", "PB");           // Public Privacy 
define("PRIVACY_PRIVATE", "PR");          // Private Privacy

/* ==================================================================
 * Constants for address table
* ==================================================================
*/
define("SELECT_ALL", "ALL");  

/* ==================================================================
 * Valid Frequences
* ==================================================================
*/
define("FRQ_DAILY","DA");     
define("FRQ_WEEKLY","WK");
define("FRQ_MONTHLY","MO"); 
/* ==================================================================
 * Constants for Metadata
* ==================================================================
*/
define("DFT_LATITUDE",43.6532);     // Toronto
define("DFT_LONGITUDE",-79.3832);    // Toronto 
/* ==================================================================
 * Constants for Map
* ==================================================================
*/
//


?>