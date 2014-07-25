<?php
	//error_reporting(0);
	require_once("Clean.php");
	require_once("TemplateHandler.php");
	require_once("MessageHandler.php");
	require_once("RequestHandler.php");

    $_SESSION['login_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$_SESSION['logout_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	###### Constants ######
	
	/* Define Constants */
	define("HOST", "competeleague.db.11835769.hostedresource.com");
	
	/* User for MYSQL */
	define("USER", "competeleague");
	
	/* Password for MYSQL */
	define("PASS", "we3Raxa@a6!ase");
	
	/* Database for MYSQL */
	define("DBASE", "competeleague");
	
	/* Debug Mode Info */
	define("MODE", 0);
	
	/* Define Plugins Directory */
	define("PLUGIN_DIR", "framework/plugins/");
	
	/* Define DirectAccess constant */
	define("DirectAccess", 0);
	
	/* Defines Document Root */
	define("DOCR", $_SERVER['DOCUMENT_ROOT']);
	
	/* Define Folder Script is Installed to. */
	define("InstallDir", "framework");
	
	
	###### Global Variables ######

	/* Global MYSQL Object */
	$mysqli = new mysqli(HOST, USER, PASS, DBASE);
	
	/* Global Template Handler Object */
	$th = new TH();
	
	/* Global Message Handler Object */
	$mh = new MH();
	
	/* Global Security Object */
	$clean = new CLEAN($mysqli);
	
	/* Global do $_GET value validates input */
	$do = $clean->cleanInput((isset($_GET['do']) ? $_GET['do'] : ""));
	
	/* Global Error Message */
	$msg = (isset($_GET['msg']) ? $_GET['msg'] : "");
	
	/* Valid Plugin Array */
	$validPlugins = array();
	
	/* League of Legends API Key */
	$lolKey = "71eec9ee-5acc-4d3a-a002-15dc63944409";
	
	/* Current Season -- First or Second */
	$currentSeason = 2;

	/* Database Name */
	$dbName = "competeleague";

	####### Global Functions #######
	
	/*
		loadPlugin - loads plugins from /plugins directory into validPlugins array
		@return null
	*/
	function loadPlugins() {
		global $validPlugins, $do;
		if($do != "") {
			if(is_dir(PLUGIN_DIR)) {
				$dir = opendir(PLUGIN_DIR);
				while (false !== ($entry = readdir($dir))) {
					if($entry != "." && $entry != "..") {
						if($do == str_replace(".php" , "", $entry)) {
							$validPlugins[] = str_replace(".php" , "", $entry);
							require_once(PLUGIN_DIR ."/".$entry);
						}
					}
					else
						continue;
				}
			}
			else {
				header("Location: index.php?msg=505");
			}
		}
	}
	/* Load Plugins */
	loadPlugins();
?>