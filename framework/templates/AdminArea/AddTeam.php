<style>
	.hiddenErr{
		color: #FF0000;
	}
</style>

<script>
	//Validates image
	function validateImage(imgFile){
		var file = imgFile.files[0];
		var name = file.name;
		var size = file.size;
		var type = file.type;
		
		if(name != "" || name != null){
			
			//Checks for valid image type
			var acceptedTypes = "image/jpg, image/png, image/jpeg";
			if(acceptedTypes.indexOf(type) == -1){
				$("#imgErr").html("Invalid Image Type, Valid: PNG, JPG, JPEG");
				errors = true;
				return "Error";
			}
			else{
				$("#imgErr").html("");
				return file;
			}
		}
	}
	
	//Submits Team for validation & submission
	function submitTeam(){
		var teamName = $('#teamName').val(); 
		var desc = $('#teamDesc').val();
		var img = $("#imgFile")[0].files[0];
		var errors = false;
		var division = $('#teamDiv').val();
		//Checks if name is empty
		if(teamName == "" || teamName == null){
			$("#nameErr").html("Please insert a team name");
			errors = true;
		}
		else
			$("#nameErr").html("");
		
	
		//Checks if Division is selected
		if(division == "NA"){
			$("#teamDivErr").html("Please select a division");
			errors = true;
		}
		else
			$("#teamDivErr").html("");
		
		
		//Checks if Team name is taken, if pass, creates new team
		if(errors == false){	
			$("#addTeamContainer").html("Processing Request, please wait...<br /><img src='images/loadingBar.gif' /><br />");

			//Processes name data, does not upload image
			$.ajax({
				type:'POST',
				url: 'framework/tools/ajaxRequests.php',
				data: {addTeam : "True", addTeam_name : teamName, addTeam_division : division},
				cache:false,

				success:function(data){
					event.preventDefault();
					if(data == "Team Name Exists")
						$("#addTeamContainer").html("There is already a team with that name, <a href='?do=AdminArea&action=AddTeam'>Try Again</a>");
					else{
						//Adds image to logos folder
						if(img != null){ 
						$("#addTeamContainer").append("Team Name available! Performing image upload...<br />");
									var xhr = new XMLHttpRequest();
									xhr.open('put', 'framework/tools/uploadImage.php', true);
									
									xhr.setRequestHeader("X-File-Name", teamName);									
									xhr.send(img);
									xhr.onload = function () {
										if(xhr.status == 200){
											if(xhr.responseText != false){
												$("#addTeamContainer").append("Logo uploaded, adding team to database...<br />");
												switch(img.type){
													case "image/jpeg" : ext = "jpeg";break;
													case "image/png" : ext = "png";break;
													case "image/jpg" : ext = "jpg";break;
												}
												data+=teamName+"."+ext+"')";
												//Submits Team to database
												$.ajax({
													type: "POST",
													url: "framework/tools/ajaxRequests.php",
													data: "addTeamDatabase=true&addTeam_name="+teamName+"&addTeam_desc="+desc+"&addTeam_division="+division+"&addTeam_ext="+ext,
													processData: false,
													success: function(data){
															if(data == "1")
																$("#addTeamContainer").html("Team successfully added! <a href='?do=AdminArea&action=AddPlayer'>Add Players to team!</a>");
															else
																$("#addTeamContainer").html("There was an error adding the team to the database");
													   }
												});
											}
											else
												$("#addTeamContainer").html("There was a problem with uploading the Logo, <a href='?do=AdminArea&action=AddTeam'>Try Again</a>");
										}
										else
											$("#addTeamContainer").html("There was a problem with uploading the Logo, <a href='?do=AdminArea&action=AddTeam'>Try Again</a>");
									}
						}
						//If image is null
						else{
							$.ajax({
								type: "POST",
								url: "framework/tools/ajaxRequests.php",
								data: "addTeamDatabase=true&addTeam_name="+teamName+"&addTeam_desc="+desc+"&addTeam_division="+division,
								processData: false,
								success: function(data){
								if(data == "1")
									$("#addTeamContainer").html("Team successfully added! <a href='?do=AdminArea&action=AddPlayer'>Add Players to team!</a>");
								else
									$("#addTeamContainer").html("There was an error adding the team to the database");
								}
							});
						
						}
					}
				},
				error: function(data){
					$("#addTeamContainer").html("There was a problem processing your request, <a href='?do=AdminArea&action=AddTeam'>Try Again</a>");
				}
			});
			
		}
			
	}

</script>
<div id="addTeamContainer">
<p>Add a new team for the current season!</p>


	<label>Team Name: <input id="teamName" type="text" /></label> <span id="nameErr" class="hiddenErr"></span><br />
	
	<label>Team Description: <input id="teamDesc" type="text" /></label> <span id="descErr" class="hiddenErr"></span> <br />
	<label>Division: </label>  	<select id="teamDiv">
									<option value="NA">Select Division</option>
									<option value="Silver">Silver</option>
									<option value="Platinum">Platinum</option>
									<option value="Diamond">Diamond</option>
								</select> <span id="teamDivErr" class="hiddenErr"></span><br />
	<label for="file">Logo:</label>
	<input type="file" id="imgFile" name="imgFile" onchange="validateImage(this)"><span id="imgErr" class="hiddenErr"></span><br>
	<input type="submit" onclick="submitTeam()" value="Add Team">
</div>