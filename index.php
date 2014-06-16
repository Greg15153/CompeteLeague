<?php
	require_once("framework/globals.php");
	$th->load("Error");
	$th->load("Header");
	if($do == "")
		$th->load("Home");
	else if($do != "" && in_array($do, $validPlugins)){
		handleRequest($do);
		$th->load($do);
	}
	else
		header("Location: index.php?msg=404");
	$th->load("Footer");
?>