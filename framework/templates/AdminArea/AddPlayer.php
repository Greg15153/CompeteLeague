<style>
	.hidden{
		color: #FF0000;
	}
</style>

<script>

	function getTeams(division){ 		
		if(division.value != "NA"){
			var team = $("#team");
			
			$.post( "framework/tools/ajaxRequests.php", {division : division.value})
				.done(function(data) {
					data = eval ("(" + data + ")");		
					team.empty();
					team.append("<option value='NA'>Select Team</option>");

					for(i=0; i<data.teams.length; i++){
						team.append("<option value='"+data.teams[i].id+"'>"+data.teams[i].name+"</option>");
					}
					$('#teamContainer').show();
					team.show();
				});
		}
		else{
			$('#team').hide();
			$('#teamContainer').hide();
		}
	}
	
	function checkPlayer(){
		var summ = $("#summoner").val();
		var pos = $("#position").val();
		var div = $("#division").val();
		var team = $("#team").val();
		var teamName = $("#team option:selected").text();
		
		var errors = false;
		
		if(summ == null || summ == ""){
			$("#summonerErr").html("Please insert a Summoner name");
			errors = true;
		}
		else
			$("#summonerErr").html("");
		if(pos == "NA"){
			$("#positionErr").html("Please select a position");
			errors = true;
		}
		else
			$("#positionErr").html("");
		if(div == "NA"){
			$("#divErr").html("Please select a division");
			errors = true;
		}
		else
			$("#divErr").html("");
		if(team == "NA"){
			$("#teamErr").html("Please select a team");
			errors = true;
		}
		else
			$("#teamErr").html("");
			
			
		if(!errors){
			$("#addPlayerContainer").html("Checking if Player exists...<br />");
			
			$.post( "framework/tools/ajaxRequests.php", {addPlayer : "true", addPlayer_name : summ, addPlayer_position : pos, addPlayer_team : team})
		    .done(function(data) {
				//If already exists
				if(data == "Player already Exists")
					$("#addPlayerContainer").html("Player already exists, please <a href='?do=AdminArea&action=EditPlayer'>edit</a> them or <a href='?do=AdminArea&action=AddPlayer'>Try Again</a>");
				else if(data != "Error")
					$("#addPlayerContainer").html(summ +" has been added to the team: "+teamName+"! <a href='?do=AdminArea&action=AddPlayer'>Add another player?</a>");
				else
					$("#addPlayerContainer").html("There was an error adding the player to the team. Please contact the system administrator!");
            });
		}
	}
</script>
<div id="addPlayerContainer">
	<p>Add a player to a team's roster</p>

	<label>Summoner: <input id="summoner" type="text" /></label><span id="summonerErr" class="hidden"></span><br />

	<label>Position: <select id="position">
						<option value="NA">Select One</option>
						<option value="Jungle">Jungle</option>
						<option value="Marksman">Marksman</option>
						<option value="Middle">Middle</option>
						<option value="Top">Top</option>
						<option value="Support">Support</option>
					</select></label><span id="positionErr" class="hidden"></span><br />

	<label>Division: <select id="division" onchange="getTeams(this)">
						<option value="NA">Select One</option>
						<option value="Silver">Silver</option>
						<option value="Platinum">Platinum</option>
						<option value="Diamond">Diamond</option>
					 </select></label><span id="divErr" class="hidden"></span><br />
	<label id="teamContainer">Team : <select id="team">
					<option value="NA">Select One</option>
				  </select></label><span id="teamErr" class="hidden"></span><br />
	<input type="submit" value="Add Player" onclick="checkPlayer()"/>
</div>
	