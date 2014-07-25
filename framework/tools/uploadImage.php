<?php
		$teamName = $_SERVER['HTTP_X_FILE_NAME'];
		$in = fopen('php://input','r');
		$out = fopen('../../images/logos/'.$teamName.'.png', 'w');
		while($data = fread($in, 1024)){
			echo fwrite($out, $data);		
		}
?>