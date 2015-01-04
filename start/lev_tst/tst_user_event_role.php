<?php
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';

include_once 'tst_connect.inc.php';       // added password

echo "*** john" . " " . 3 . " " . 1 .  " " . "\n";

$user_on_event=check_user_event_role('john', 3,  1);
if ($user_on_event) {
	print_r("True\n");
}
else {
	print_r ("False\n");
}

echo "*** shepjohnlee@gmail.com" . " " . 3 . " " . 2 .  " " . "\n";

$user_on_event=check_user_event_role('shepjohnlee@gmail.com', 3,  2);
if ($user_on_event) {
	print_r("True\n");
}
else {
	print_r ("False\n");
}


echo "*** shepjohnlee@gmail.com" . " " . 3 . " " . 1 .  " " . "\n";

$user_on_event=check_user_event_role('shepjohnlee@gmail.com', 3,  1);
if ($user_on_event) {
	print_r("True\n");
}
else {
	print_r ("False\n");
}


echo "*** lev.ostromich@gmail.com" . " " . 1 . " " . 1 .  " " . "\n";

$user_on_event=check_user_event_role('lev.ostromich@gmail.com', 1,  1);
if ($user_on_event) {
	print_r("True\n");
}
else {
	print_r ("False\n");
}

echo "*** lev.ostromich@gmail.com" . " " . 7 . " " . 3 .  " " . "\n";

$user_on_event=check_user_event_role('lev.ostromich@gmail.com', 7,  3);
if ($user_on_event) {
	print_r("True\n");
}
else {
	print_r ("False\n");
}


?>


