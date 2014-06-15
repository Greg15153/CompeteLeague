<?php
	class MH {
		public function load($file){
			if(is_file("framework/messages/".$file.".php") && $file != "")
				include("messages/".$file.".php");
			else
				header("Location: index.php");
		}
	}
?>