<?php
	include_once("framework/templates/left-nav.php");
	global $mysqli;
	
	if (login_check($mysqli) == false) {
?>
		<h3>Login</h3><br />
        <form method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" name="password"  id="password"/>
            <input type="button" value="Login" onclick="formhash(this.form.email, this.form.password);" /> 
        </form>
		
        <p>If you don't have a login, please <a href="?do=Register">register</a></p>
<?php
} else {
?>
		<script>window.location.href="?msg=102"</script>
<?php
}
?>
