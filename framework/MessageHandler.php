<?php
	class MH {
		public function load($file){
			if(is_file("framework/messages/".$file.".php") && $file != ""){
?>
			<div id="errorMessage" style="background-color: #E53e39; color: #FFFFFF; text-align: center; width: 100%; margin-top: 44px;">
<?php
				include_once("messages/".$file.".php");
?>
			</div>
<?php
			}
			else
				header("Location: index.php");
		}
	}
?>