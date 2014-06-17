<?php
	include_once "../globals.php";

if (isset($_POST['loginEmail'], $_POST['loginPassword'])) {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        echo "Success";
    } else {
        // Login failed 
        echo "Failure";
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}
	
?>