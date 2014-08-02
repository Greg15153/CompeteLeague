<?php global $seasonSQL; ?>
<style>
   #submitGameContainer
    {
        margin: 0px auto;  
        width: 80%;
        text-align: center;
        background-color: #FFFFFF;
    }

    #team1Container
    {
        float: left;
    }
    
    #team2Container
    {
        float: right;
    }

    .hidden{
        display: none;
        color: red;
        position: absolute;
        margin: -20px;
    }
    
    .adminTable, .adminTable td, .adminTable tr
    {
        vertical-align: center;
        border-collapse: separate;
        border-spacing: 10px;
        user-select: none;
        -moz-user-select: none;
    }
    .adminTable img
    {
        width: 30px;
        height: 30px;
    }
</style>
<script>
//Gets the teams from selected division
function getTeams(division){ 
    var team1 = $('#team1');
    var team2 = $('#team2');
	
    if(division.value != "NA"){
        $.post( "framework/tools/ajaxRequests.php", {division : division.value})
		    .done(function(data) {
                data = eval ("(" + data + ")");		
                team1.empty();
                team2.empty();
                $("#winner").empty();
                team1.append("<option value='NA'>Select Team</option>");
                team2.append("<option value='NA'>Select Team</option>");

                for(i=0; i<data.teams.length; i++){
                    team1.append("<option value='"+data.teams[i].id+"'>"+data.teams[i].name+"</option>");
                    team2.append("<option value='"+data.teams[i].id+"'>"+data.teams[i].name+"</option>");
                }
                $('#team1Container').show();
                $('#team2Container').show();
                $('#team1Table').empty();
                $('#team2Table').empty();
            });
	}
    else{
        $('#team1Container').hide();
        $('#team2Container').hide();
    }
}

//Gets all Players from a selected team
function getPlayers(team, teamSel){
    var team1 = $('#team1');
    var team2 = $('#team2');
    var selected = team.options[team.selectedIndex].text;
    $('#'+teamSel+'Table').empty();
    $('#'+teamSel+'Table').html("<tr><th></th><th>Position</th><th>Summoner</th><th>Played</th></tr>");
    
    if(team.value != "NA" && team1.val() != team2.val() ){
        $('#winner option').each(function() {
            if($(this).attr("name") == teamSel){
                $(this).remove();
            }
        });
         $("#winner").append("<option name='"+teamSel+"' value='"+team.value+"'>"+selected+"</option>");
       $.post( "framework/tools/ajaxRequests.php", {team : team.value})
    	    .done(function(data) {				
                data = eval ("(" + data + ")");		
                for(i=0; i<data.players.length; i++)
                    $('#'+teamSel+'Table tr:last').after("<tr id='"+teamSel+i+"' onclick='makeRowClickable(\""+teamSel+i+"\")'><td><img src='http://www.competeleague.com"+data.players[i].profilePicture+"' /></td><td>"+data.players[i].position+"</td><td>"+data.players[i].summoner+"</td><td><input alt='"+data.players[i].id+"' value='"+data.players[i].LoLid+"'type='checkbox' id='"+teamSel+i+"Check'name='"+teamSel+"'/></td></tr>");
                    
                $('#'+teamSel+'Table').show();
                $("#"+teamSel+"Err").hide();
            });
    }
    else{
        if(team.value == "NA")
            $("#"+teamSel+"Err").html("Please select a team.");
        else
            $("#"+teamSel+"Err").html("Teams cannot be the same.");
        
        $("#"+teamSel+"Err").show();
    }
}


function submitGame(){
    var team1 = $('#team1').val();
    var team2 = $('#team2').val();
    var division = $('#divisionSelect').val();
    var date = $('#datePlayed').val();
    var winner = $('#winner').val();
    var problems = false;
    var matchProblem = false;
    var selProblem1 = false;
    var selProblem2 = false;
    
    if(division == "NA"){
        $("#divisionErr").html("Please select a division");
        $("#divisionErr").show();
        problems = true;
    }
    else
        $("#divisionErr").hide();
        
   if(team1 == team2 && (team1 != "NA" && team2 != "NA")){
        $("#team1Err").html("Teams cannot be the same");
        $("#team2Err").html("Teams cannot be the same");
        $("#team1Err").show();
        $("#team2Err").show();
        problems = true;
        matchProblem = true;
    }
    else{
        $("#team1Err").hide();
        $("#team2Err").hide();
    }
    
    if(team1 == "NA"){
        $("#team1Err").html("Please select a team");
        $("#team1Err").show();
        problems = true;
        selProblem1 = true;
    }
    else if(!matchProblem)
        $("#team1Err").hide();
    
    if(team2 == "NA"){
        $("#team2Err").html("Please select a team");
        $("#team2Err").show();
        problems = true;
        selProblem2 = true;
    }
    else if(!matchProblem)
        $("#team2Err").hide();

    if(!isValidDate(date)){
        $("#dateErr").html("Validate date: YYYY-mm-dd");
        $("#dateErr").show();    
        problems = true;
    }
    else
        $("#dateErr").hide();
        
    var selTeam1 = [];
    var selTeam2 = [];
    var selTeam1ID = [];
    var selTeam2ID = [];
//Gets selected Checkboxes for team1
    $('input[type="checkbox"][name=team1]:checked').map(function() { 
        selTeam1.push(this.value);
        selTeam1ID.push(this.alt);
    }).get();
//Gets selected Checkboxes for team2
    $('input[type="checkbox"][name=team2]:checked').map(function() { 
        selTeam2.push(this.value);
        selTeam2ID.push(this.alt);
    }).get();
    
    if(!matchProblem){
        if(!selProblem1)
            if(selTeam1.length !== 5){
                $("#team1Err").html("Please select 5 players");
                $("#team1Err").show();
                problems = true;
            }
        if(!selProblem2)
            if(selTeam2.length != 5){
                $("#team2Err").html("Please select 5 players");
                $("#team2Err").show();
                problems = true;
            }
    }
        
    if(!problems){
        $("#rightContainer").html("<div id='loadingInfo'>Processing input, will take a minute or so, please wait.<br /><img src='../images/loadingBar.gif' /></div>");
    
        $.post( "framework/tools/ajaxRequests.php", {submitGame : "true", SGteam1 : team1, SGteam2 : team2, SGdivision : division, SGdate : date, SGwinner : winner, 'SGteam1Sel[]' : selTeam1, 'SGteam2Sel[]' : selTeam2, 'SGteam1ID[]' : selTeam1ID, 'SGselTeam2ID[]' : selTeam2ID})
    	 .done(function(data) {
                if(data == "Game Exists")
                    $("#rightContainer").html("Game already exists, <a href='?do=AdminArea&action=AddGame'>Try Again</a>");
                else if(data == "Match not Found")
                    $("#rightContainer").html("There was a problem locating the match, <a href='?do=AdminArea&action=AddGame'>Try Again</a>");
				else if(data == "Recent matches failure")
					$("#rightContainer").html("Could not locate game ID, have all players of the game update their profile (change their league avatar)! This is a temporary bug with League's API... <a href='?do=AdminArea&action=AddGame'>Try Again</a>");
				else if(data == "Unable to get game ID")
					$("#rightContainer").html("Could not locate game ID, have all players of the game update their profile (change their league avatar)! This is a temporary bug with League's API... <a href='?do=AdminArea&action=AddGame'>Try Again</a>");
                else
                    $("#rightContainer").html("Your game has been submitted successfully!");
        });
    }
        
}

function makeRowClickable(row){
    $('#'+row).click(function(event) {
    if (event.target.type !== 'checkbox') {
      $('#'+row+"Check").prop("checked", !$('#'+row+'Check').prop("checked"));
    }
  });
}

function isValidDate(date){
    var matches = /(\d{4})[-\/](\d{2})[-\/](\d{2})/.exec(date);
    if (matches == null) return false;
    var day = matches[3];
    var month = matches[2] - 1;
    var year = matches[1];
    var composedDate = new Date(year, month, day);
    return composedDate.getDate() == day &&
             composedDate.getMonth() == month &&
             composedDate.getFullYear() == year;
}
</script>
                            <div id="rightContainer" class="8u skel-cell-mainContent">
    								<div id="content">
                                        <p>After a game has finished you can submit the required fields to save the game and the stats from the game.</p>
									    <span id="divisionErr"  class='hidden'><br /></span>
                                        <label>Division: <select id="divisionSelect" onchange="getTeams(this)">
                                        <option value="NA">Select Division</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Platinum">Platinum</option>
                                        <option value="Diamond">Diamond</option>
                                        </select></label>
                                        <br /><br />
                                     <div id="team1Container"  style="display: none">
                                        <span id='team1Err'  class='hidden'><br /></span>
                                        <label>Team 1: <select id="team1" onchange="getPlayers(this, 'team1')"></select></label>
                                        <table id="team1Table" class="adminTable" style="display: none;"></table>
                                     </div>
                                     <div id="team2Container"  style="display: none">
                                        <span id='team2Err' class='hidden'><br /></span>
                                        <label>Team 2: <select id="team2" onchange="getPlayers(this, 'team2')"></select></label>
                                          <table id="team2Table" class="adminTable" style="display: none"></table>
                                     </div>
                                     <div style='clear: both'><br /><br /></div>
                                    <div id='itemContainer'>
                                        <span id="dateErr" class="hidden"></span>
                                        <label>Date: <input id='datePlayed' type='date' /></label>
                                        <label>Winner: <select id='winner'></select></label><br />
                                        <input type='submit' id='submitGame' value='Submit Game' onclick='submitGame()' />
                                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</body>

