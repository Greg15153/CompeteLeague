<?php
	include_once("framework/globals.php");
	global $mysqli;

	if (!login_check($mysqli)) {
		header("location: ?msg=101");
	}
?>
<div id="success">You have Successfully Logged in <?=$_SESSION['username']?>!</div>