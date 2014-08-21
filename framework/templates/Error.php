<?php
	require_once("framework/globals.php");
	global $mh, $msg;
	if($msg != "") {
		$mh->load($msg);
	}
?>
