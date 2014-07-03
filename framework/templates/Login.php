<?php
	include_once("framework/templates/left-nav.php");
	global $mysqli;
	
	if (login_check($mysqli) == false) {
?>
		<h3>Login</h3><br />
<?php
		ssi_login();
?>
		
        <p>If you don't have a login, please <a href="?do=Register">register</a></p>
<?php
} else {
?>
		<script>window.location.href="?msg=102"</script>
<?php
}
?>
