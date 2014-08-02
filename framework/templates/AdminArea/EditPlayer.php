<style>
input{
	text-align: center;
}
</style>
<script>
function getTeams(division){ 
	var team = $("#team");
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
		$("#playerInfo").hide();	
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
		$("#playerInfo").hide();		
    }
}

function getPlayerInfo(player){
	var playerInfoTbl = $("#playerInfo");

	if(player.value != "NA"){
		playerInfoTbl.empty();
		playerInfoTbl.append("<tr><th>ID</th><th>Summoner</th><th>LoL ID</th><th>Team</th><th>Position</th></tr>");
		
		$.post( "framework/tools/ajaxRequests.php", {getPlayerInfo : player.value})
    	    .done(function(data) {
				data = eval ("(" + data + ")");
				playerInfoTbl.append("<tr align='center'><td>"+data.id+"</td><td><input type='text' value='"+data.summoner+"' /></td><td>"+data.LoLid+"</td><td>"+data.teamName+"</td><td>"+
					"<select id='playerPos'><option value='Jungle'>Jungle</option><option value='Marksman'>Marksman</option><option value='Middle'>Middle</option><option value='Top'>Top</option><option value='Support'>Support</option><option value='Substitute'>Substitute</option></select>"
					+"</td></tr>");
					
				$("#playerPos").val(data.position).prop('selected', true);
            });
			
			
		playerInfoTbl.show();
	}
	else{
		playerInfoTbl.hide();
	}
}
</script>
<p>Edit Player</p>

<div id="editPlayerContainer">
	<select id="division" onchange="getTeams(this)">
		<option value="NA">Select Division</option>
		<option value="Silver">Silver</option>
		<option value="Platinum">Platinum</option>
		<option value="Diamond">Diamond</option>
	</select>
	
	<select id="team" style="display: none;" onchange="getPlayers(this)">
	</select>
	
	<select id="player" style="display: none;" onchange="getPlayerInfo(this)">
	</select>
	
	<table id="playerInfo" style="display: none; width: 100%;">
	</table>
</div>
