<style>
input{
	text-align: center;
}
</style>
<script>
function getTeams(division, playerTeam){ 
	if(playerTeam)
		var team = $("#team");
	else
		var team = $("#playerTeam");
		
    if(division.value != "NA"){
		
        $.post( "framework/tools/ajaxRequests.php", {division : division.value})
		    .done(function(data) {
				team.empty();
                data = eval ("(" + data + ")");		
                team.append("<option value='NA'>Select Team</option>");

                for(i=0; i<data.teams.length; i++)
                    team.append("<option value='"+data.teams[i].id+"'>"+data.teams[i].name+"</option>");
                
                team.show();
            });
	}
    else{
        team.hide();
		$("#player").hide();
		$("#playerInformation").hide();	
    }
}

//Gets all Players from a selected team
function getPlayers(team){	 
	var player = $("#player");
	
    if(team.value != "NA"){
        $.post( "framework/tools/ajaxRequests.php", {team : team.value})
    	    .done(function(data) {
				player.empty();
				data = eval ("(" + data + ")");
				
				player.append("<option value='NA'>Select Player</option>")
				
                for(i=0; i<data.players.length; i++)
                    player.append("<option value='"+data.players[i].id+"'>"+data.players[i].summoner+"</option>");
					
                player.show();
				
            });
    }
    else{
        player.hide(); 
		$("#playerInformation").hide();		
    }
}

function getPlayerInfo(player){
	var playerInfoTbl = $("#playerInfo");
	var playerInfo = $("#playerInformation");
	
	if(player.value != "NA"){
		playerInfoTbl.empty();
		playerInfoTbl.append("<tr><th>ID</th><th>Summoner</th><th>LoL ID</th><th>Division</th><th>Team</th><th>Position</th></tr>");
		
		$.post( "framework/tools/ajaxRequests.php", {getPlayerInfo : player.value})
    	    .done(function(data) {
				data = eval ("(" + data + ")");
				playerInfoTbl.append("<tr align='center'><td id='playerId'>"+data.id+"</td><td><input id='playerSumm' type='text' value='"+data.summoner+"' /></td><td>"+data.LoLid+"</td><td>"+
					"<select id='playerDivision' onchange='getTeams(this, false)'><option value='Silver'>Silver</option><option value='Platinum'>Platinum</option><option value='Diamond'>Diamond</option></select>"
				+"</td><td>"+
					"<select id='playerTeam'></select>"
				+"</td><td><select id='playerPos'><option value='Jungle'>Jungle</option><option value='Marksman'>Marksman</option><option value='Middle'>Middle</option><option value='Top'>Top</option><option value='Support'>Support</option><option value='Substitute'>Substitute</option></select>"
					+"</td></tr>");
					
				var $options = $("#team > option").clone();
				$('#playerTeam').append($options);
				$("#playerTeam").val($("#team").val()).prop('selected', true);
				$("#playerDivision").val($("#division").val()).prop('selected', true);
				$("#playerPos").val(data.position).prop('selected', true);
            });
			
			
		playerInfo.show();
	}
	else{
		playerInfo.hide();
	}
}


function updatePlayerInformation(){
			var summoner = $("#playerSumm").val();
			var id = $("#playerId").html();
			var position = $("#playerPos").val();
			var division = $("#playerDivision").val();
			var team = $("#playerTeam").val();
			var errors = "";
			
			if(summoner == "")
				errors+="Summoner must have a value.\r\n";
			if(team == "NA")
				errors+="Please select a team.\r\n";
			
			if(errors == ""){
				$.post( "framework/tools/ajaxRequests.php", {editPlayer : "true", editPlayer_summoner : summoner, editPlayer_id : id, editPlayer_position : position, editPlayer_division : division, editPlayer_team : team})
				.done(function(data) {
					alert(data);
					//data = eval ("(" + data + ")");
				});
			}else{
				alert(errors);
			}
}
</script>
<p>Edit Player</p>

<div id="editPlayerContainer">
	<select id="division" onchange="getTeams(this, true)">
		<option value="NA">Select Division</option>
		<option value="Silver">Silver</option>
		<option value="Platinum">Platinum</option>
		<option value="Diamond">Diamond</option>
	</select>
	
	<select id="team" style="display: none;" onchange="getPlayers(this)">
	</select>
	
	<select id="player" style="display: none;" onchange="getPlayerInfo(this)">
	</select>
	<br /><br />
	<div id="playerInformation" style="display: none;">
		<table id="playerInfo" style="width: 100%;">
		</table>
		<input type='submit' value="Update Player" style="float: right;" onclick="updatePlayerInformation()"/>
	</div>
</div>
