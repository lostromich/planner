<?php
	session_start();
	$cxn = mysqli_connect('localhost','wonder','wonder','wonder') or die('Please check the connection valve!'); // added password
	$sqlSelect = "SELECT reg_events FROM users WHERE username = '".$_SESSION['SESS_username']."' ";
	$query_result = mysqli_query($cxn, $sqlSelect) OR die('Error:'.mysqli_error($cxn));
	$ue =mysqli_fetch_array($query_result);
	print_r ($ue[0]);
	$uer = explode ( "," , $ue[0]);//this will be used in the calendar to identify the the events to be populated
	echo "<table border='1px solid black'>
		<thead>
			<th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
		</thead>";
	// RFS0001 - Start 
	// $timestamp = $_POST["first"];
	$timestamp = $_SESSION["first"]; 
	$fill = $_SESSION["second"];
	// RFS0001 - End
	$date=getdate($timestamp);
	$mon=$date['mon'];
	$mday=$date['mday'];
	$wday=$date['wday'];
	$year=$date['year'];
	$fdate = $year.'-'.$mon.'-'.$mday;
	echo '<tr>';
	$ct=1;
	for ($c=0;$c<$wday;$c++){
		if ($fill==='true'){
			$offset = $wday - $c;
			$date = strtotime("-".$offset." day", strtotime($fdate));
			echo '<td class="phptd">';
			$month = date('m', $date);
			$day = date("d", $date);
			echo $day;
			foreach ($uer as $i) {
				$calendarsql = "SELECT * FROM events WHERE eID = $i AND DAY(sdate_time) = $day AND MONTH(sdate_time) = $mon AND YEAR(sdate_time) = $year";
				$calendarquery = mysqli_query($cxn, $calendarsql) OR die('Error:'.mysqli_error($cxn));
				$row =mysqli_fetch_array($calendarquery);
				if ("$row[genre]" == ''){
				}
				else {
					echo  "<img src='icons/$row[genre].png' /><a class='eventlink' href='e.php?eventID=$row[eID]'>$row[eventName]</a>";
				}
			}
			echo '</td>';
			$ct++;
		}
		else {
			echo '<td class="daytd"></td>';
			$ct++;
		}
	}
	for ($c=0;$c<36-$ct;$c++){
		$date = strtotime("+".$c." day", strtotime($fdate));
		if (($c+$ct)%7==0){
			echo '<td class="daytd">';
			$month = date('m', $date);
			$day = date("d", $date);
			echo $day;
			foreach ($uer as $i) {
				$calendarsql = "SELECT * FROM events WHERE eID = $i AND DAY(sdate_time) = $day AND MONTH(sdate_time) = $mon AND YEAR(sdate_time) = $year";
				$calendarquery = mysqli_query($cxn, $calendarsql) OR die('Error:'.mysqli_error($cxn));
				$row =mysqli_fetch_array($calendarquery);
				if ("$row[genre]" == ''){
				}
				else {
					echo  "<img src='icons/$row[genre].png' /><a class='eventlink' href='e.php?eventID=$row[eID]'>$row[eventName]</a>";
				}
			}
			echo '</td></tr><tr>';
		}
		else {
			echo '<td class="daytd">';
			$month = date('m', $date);
			$day = date("d", $date);
			echo $day;
			foreach ($uer as $i) {
				$calendarsql = "SELECT * FROM events WHERE eID = $i AND DAY(sdate_time) = $day AND MONTH(sdate_time) = $mon AND YEAR(sdate_time) = $year";
				$calendarquery = mysqli_query($cxn, $calendarsql) OR die('Error:'.mysqli_error($cxn));
				$row =mysqli_fetch_array($calendarquery);
				if ("$row[genre]" == ''){
				}
				else {
					echo  "<img src='icons/$row[genre].png' /><a class='eventlink' href='e.php?eventID=$row[eID]'>$row[eventName]</a>";
				}
			}
			echo '</td>';
		}
	}
	echo '</tr></table>';
?>