<?php
	class logger {
		
		public function __construct() { } 
		
		public function getContent($file){
			return file_get_contents($file);
		}
		
		public function addLog($file, $curent, $date, $title, $msg){
			return $date . " [".$title."] - ".$msg."\r\n";
		}
		
		public function saveLog($file, $current){
			return file_put_contents($file, $current);
		}
		
		public function getDate(){
			return date("Y-m-d H:i:s");
		}
	}
?>