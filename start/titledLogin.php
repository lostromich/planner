<?php
	session_start();
	$cxn = mysqli_connect('localhost','wonder','wonder','wonder') or die('Please check the connection valve!');
	$_SESSION['SESS_username'] = $_REQUEST['username'];
	$sqlSelect = "SELECT * FROM users WHERE username = '".$_POST['username']."' AND  password = '".$_POST['password']."'";
	$data=mysqli_query($cxn,$sqlSelect) OR die('Error:'.mysql_error());
	$row=mysqli_fetch_assoc($data);
	$numCount=mysqli_num_rows($data);
	$userID =  $row[ID];
	//$userID = $_GET['ID'];
	if ($numCount>0){
		$_SESSION['SESS_isLoggedIn']=1;
		
		// RFS0001 - Start
		$_SESSION['first']=$_REQUEST['first'];
		$_SESSION['second']=$_REQUEST['second'];
		// RFS0001 - End 
		
		header("location:titled2.php"); // ???
	}
	else{
		echo "login unsuccessful";
	}
?>