	
	//Checks if Valid Email Address
	function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    }
    
	//Sends an email -- Made for Contact Page ONLY -- Will come back and edit this to make it more dynamic
    function sendEmail(){
        var content = $("#emailContent").val();
        var email = $("#emailList").val();
        var from = $("#fromEmail").val();
        var problems = false;
        
        
        if(email == "NA"){
            problems = true;
            $("#hiddenSelect").show();
        }
        else
            $("#hiddenSelect").hide();
        if(content == ""){
            problems = true;
            $("#hiddenContent").show();
        }
        else
            $("#hiddenContent").hide();
            
        if(!isValidEmailAddress(from)){
           problems = true;
           $("#hiddenEmail").show();
        }
        else
            $("#hiddenEmail").hide();
        
            if(!problems){
                $.post( "../framework/tools/ajaxRequests.php", {emailContent : content, email : email, from : from})
    	        .done(function( data ) {					
			         $("#content").html("Your email has been sent, we will reach out to you shortly. Thank You!");
	            });
            }
        }
		
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
	
		function loginPopup(){
			if($(".loginPopup").css('display') == "block")
				$(".loginPopup").hide();
			else
				$(".loginPopup").show(); 
			$(".closePopup").click(function(e) { 
				$(".loginPopup, .overlay").hide(); 
			}); 
		}
