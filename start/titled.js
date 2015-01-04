var unix = Math.round(+new Date()/1000); //setting up the date variable of the user and passing it to the php
var fill = false;
var res = function(data) {
	document.getElementById("month").innerHTML=data;
	};                       // RFS00001 - added semicolon
function myajax() {
	$.post("titled1.php", {first: unix, second: fill}, res);
	//$.post("titled2.php", {first: unix, second: fill}, res);
	}
window.onload = myajax();//this will generate the calendar on window load
var d=new Date();
var curr_date=d.getDate();
var curr_day=d.getDay();
var curr_month=d.getMonth();
var curr_year=d.getFullYear();
var c_hour=d.getHours();        
var c_min=d.getMinutes();
var c_sec=d.getSeconds();
months=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
days=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
days_in_month =new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
var day_name=days[curr_day];
var month_name=months[curr_month];
function timeHeader() {
    // call this function again in 1000ms to make sure Time is rolling on
    //setInterval("timeHeader()", 1000);
    var t=month_name+" "+curr_year;
    document.getElementById("timeheader").innerHTML=t;
}
function forward() {
	unix = unix + 604800; //this adds a weeks worth of seconds
	if (fill == false) {
		fill = true;
	}
	myajax(); //repopulates the calendar
}
function backward() {
	unix = unix - 604800;
	if (fill == false) {
		fill = true;
	}
	myajax();
}
function openLogIn(){
	document.getElementById("logInForm").style.display="block";
}
function closeLogIn(){
	document.getElementById("logInForm").style.display="none";
}