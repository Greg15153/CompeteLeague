<?php
	global $mysql, $do, $clean;
	
	$allData = array();
	getAllData();
	
	/*
		Checks to make sure the action is valid
	*/
	function isValidAction($do){
		global $validPlugins;
			if(in_array($do, $validPlugins)) {
				return $do;
			}
			else {
				header("Location: index.php?msg=100");
			}
	}
	
	/*
		Handles the request and parses the data
	*/
	function handleRequest($do){
		if(isValidAction($do)) {
			parseData();
		}
		else {
			header("Location: index.php?msg=404");
		}
	}
	/*
		finds all get data from the URL
	*/
	function parseData() {
		global	$allData, $clean;
		$temp = array();
		foreach($allData as $key){
			if($key != "do") {
				$cleaned = $clean->checkInput($_GET[$key], TYPE_GENERIC);
				array_push($temp, $cleaned);
			}
		}
		createObj($temp);
	}
	/* 
		Creates object based off of request type	
	*/
	function createObj($val){
		global $do;
		$obj = new $do($val);
		$obj->run();
	}	
	
	/*
		Gets all data from all $_GET keys and stores it in a global array
	*/
	function getAllData() {
		global $allData;
			foreach($_GET as $key => $value) {
				array_push($allData, $key);
			}
	}
?>