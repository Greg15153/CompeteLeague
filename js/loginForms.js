function formhash(email, password) {
	$.post( "framework/tools/process_login.php", {loginEmail : email.value, loginPassword : hex_sha512(password.value)})
		.done(function(data) {
			var url = getUrlVars()["do"];
			if(url == "Login" || url == null)
				url = "Home";
			if(data == "Success")
				window.location.replace("?do="+url+"&msg=LoggedIn");
			else
				alert("Invalid Username or Password");
    });
}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('You must provide all the requested details. Please try again');
        return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("Username must contain only letters, numbers and underscores. Please try again"); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }
	
	$.post( "framework/tools/register.inc.php", {username : form.username.value, email : email.value, password : hex_sha512(password.value)})
		.done(function(data) {
			var url = getUrlVars()["do"];
			if(data == "Success")
				window.location.replace("?do="+url+"&msg=Registered");
			else if(data == "Email Exists")
				window.location.replace("?do="+url+"&msg=103");
			else if(data == "User Exists")
				window.location.replace("?do="+url+"&msg=104");
			else if(data == "Database Failure")
				window.location.replace("?do="+url+"&msg=500");
			else
				window.location.replace("?do="+url+"&msg=100");
	});
	
}

function logout(){
		var url = getUrlVars()["do"];
		if(url == null)
			url = "Home";
		$.post( "framework/tools/logout.php")
		.done(function(data) {
			if(data == "Success")
				window.location.replace("?do="+url+"&msg=LoggedOut");
			else if(data == "Failure")
				window.location.replace("?do="+url+"&msg=101");
	});
}