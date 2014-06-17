<?php
	include_once("framework/globals.php");
	global $mysqli;

	if (login_check($mysqli) == true) {
		window.location.replace("?msg=102");
}
?>
You have Successfully Logged out!