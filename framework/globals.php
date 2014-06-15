<?php
	session_start();
	ob_start();

	error_reporting();
	require_once("mysql.php");
	require_once("Clean.php");
	require_once("MessageHandler.php");
	
	###### Constants ######
	
	/* Define Constants */
	define("SEASONHOST", "clseason2014.db.11835769.hostedresource.com");
	define("LOGINHOST", "clmembersDB.db.11835769.hostedresource.com");
    
	/* User for MYSQL */
	define("SEASONUSER", "clseason2014");
	define("LOGINUSER", "clmembersDB");
    
	/* Password for MYSQL */
	define("SEASONPASS", "Huzubre4!");
	define("LOGINPASS", "we3Raxa@a6!ase");
    
	/* Database for MYSQL */
	define("SEASONDBASE", "clseason2014");
	define("LOGINBASE", "clmembersDB");
    
	/* Debug Mode Info */
	define("MODE", 0);
	
	/* Define DirectAccess constant */
	define("DirectAccess", 0);
	
	/* Defines Document Root */
	define("DOCR", $_SERVER['DOCUMENT_ROOT']);
	
	/* Define Folder Script is Installed to. */
	define("InstallDir", "framework");
	
	
	###### Global Variables ######

	/* Global MYSQL Object */
	$seasonSQL = new MYSQL(SEASONHOST, SEASONUSER, SEASONPASS, SEASONDBASE);
    $loginSQL = new MYSQL(LOGINHOST, LOGINUSER, LOGINPASS, LOGINDBASE);
    
	/* Global Message Handler Object */
	$mh = new MH();
	
	/* Global Security Object */
	$clean = new CLEAN($mysql);
	
	/* Global do $_GET value validates input */
	$do = $clean->cleanInput((isset($_GET['do']) ? $_GET['do'] : ""));
	
	/* Global Error Message */
	$msg = (isset($_GET['msg']) ? $_GET['msg'] : "");
	
	/* Valid Plugin Array */
	$validPlugins = array();
	
	/* League of Legends API Key */
	$lolKey = "71eec9ee-5acc-4d3a-a002-15dc63944409";
	
    /* Current Season -- First or Second*/
    $currentSeason = 2;
    
    /* Database Name */
    $dbName = "clseason2014";
	####### Global Functions #######

?>