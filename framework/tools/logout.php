<?php
	include_once '../globals.php';
	global $mysqli;
	
	if (login_check($mysqli) == false) {
		echo "Failure";
	}
	else{
		// Unset all session values 
		$_SESSION = array();
		 
		// get session parameters 
		$params = session_get_cookie_params();
		 
		// Delete the actual cookie. 
		setcookie(session_name(),
				'', time() - 42000, 
				$params["path"], 
				$params["domain"], 
				$params["secure"], 
				$params["httponly"]);
		 
		// Destroy session 
		session_destroy();
		if(!isset($_SESSION['username']))
			echo "Success";
		else
			echo "Failure";
	}
?>
