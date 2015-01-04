<?php
// ==========================================================
// Description:
// Hash the passing password using crypt function and return the 
// result of the crypt function. This result usually is stored in db
//
// Parameters and results:
// (str,str) -> str
//
// $user - user name/email
// $pssw - password to be verified, usually entered by user
//
// Exception handling: 
// ==========================================================
function cryptPssw($user, $pssw) {
	$hash = crypt(md5($pssw),md5($user));
// Return the result	
	return $hash;
}

// ==========================================================
// Description:
// Verify if password is correct
// 
// Parameters and results:
// (str,str, str)->bool
//
// $user - user name/email
// $pssw - password to be verified, usually entered by user
// $hash - hashed password , usually stored in db and retrieved from db
//
// Exception handling:
// ==========================================================
function chkPssw($user, $pssw, $hash) {
	// Return true if password match 
	return (crypt(md5($pssw),md5($user)) == $hash); 
}

// ==========================================================
// Description:
// Generate random password. This function may be used as part 
//  of password recovery process.
// Recovered password have to be send to user by secured channel.
//
// Parameters and results:
// ()->str
//
// Exception handling:
// ==========================================================
function genRandPssw() {
// Set up the string of characters
	// $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	// Use lowercase characters to make the password typing easier
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	
	$length = rand(5,8);
	$randPssw = substr(str_shuffle($chars),0,$length);
// Return the resulting random password
    return ($randPssw); 
}
?>