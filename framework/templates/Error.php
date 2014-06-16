<?php
	require_once("framework/globals.php");
	global $mh, $msg;
	if($msg != "") {
?>
	<div id="error">
<?php
		$mh->load($msg);
?>
	</div>
<?php
	}
?>
