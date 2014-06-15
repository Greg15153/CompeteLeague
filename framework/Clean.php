<?php
	/* TYPE_GENERIC - an input type including strings and numbers and symbols */
	define("TYPE_GENERIC", 0);
	/* TYPE_INT - an input type of integer/double */
	define("TYPE_INT", 1);
		
	class CLEAN {
		/* 
			__construct - Constructs the CLEAN object.
			
			@param $mysql - MYSQL object required for mysql_real_escape_string function
		*/
		public function __construct($mysql){
			$this->mysql = $mysql;
		}
		
		/* 
			checkInput - checks to ensure input being sent is valid.
			
			@param $input - Input value
			@param $type - Type of input: TYPE_GENERIC, TYPE_INT
			
			@return returns -1 if not valid, otherwise returns cleaned input
		*/
		public function checkInput($input, $type) {
			//If the input needs to be a number
			if($type == TYPE_INT) {
				//if it is not, then return -1
				if(!is_numeric($type)) {
					header("Location: index.php?msg=100");
				}
				else {
					return $input;
				}
			}
			//If it is a generic input
			else if($type == TYPE_GENERIC) {
				return $this->cleanInput($input);
			}
			else {
				header("Location: index.php?msg=100");
			}
		}
		
		/*
			cleanInput - function to clean input of malicious characters.
			
			@param $input - Input value
			
			@return returns cleanedInput
		*/
		public function cleanInput($input) {
			$input = htmlentities($input);
			$cleaned = mysql_real_escape_string($input);
			
			return $cleaned;
		}
	}
?>