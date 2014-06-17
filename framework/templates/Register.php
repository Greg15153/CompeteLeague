<?php include_once("framework/templates/left-nav.php");  ?>

        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h3>Register</h3><br />
		<form>
			<table>
				<tr>
					<td><label>Username<br /><input type='text' name='username' id='username' /></label></td>
				</tr>
				<tr>
					<td><label>Email<br /><input type="text" name="email" id="email" /></label></td>
				</tr>
				<tr>
					<td><label>Password <br /><input type="password" name="password" id="password"/><label>
				</tr>
				<tr>
					<td><label>Confirm password <br/><input type="password" name="confirmpwd" id="confirmpwd" /></label>
				</tr>
				<tr>
					<td><input type="button" value="Register" onclick="return regformhash(this.form,this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" /></td> 
				</tr>
			</table>
		</form>
        <ul style="float right; font-size: 10px;">
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain:</li>
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
				</ul>
			<li>Your password and confirmation must match exactly</li>
		</ul>
        <p>Return to the <a href="?do=Login">login page</a>.</p>
    </body>
</html>