<?php include_once("framework/templates/left-nav.php"); global $mysqli;?>


<script>
	//displays selected team
	function changeTeamDisplayed(selected){
		if(selected.value != "NA"){
			$(".statsContainer").hide();
			$("#"+selected.value).show();
		}
		else
			$(".statsContainer").show();
	}
	
	function changeRoster(){
		$("#content").html("<iframe src='https://docs.google.com/forms/d/1gC9wkqQVTcz6g1c1U4eG2xKuPPMIktdr_dQEHr8tAF4/viewform?embedded=true' width='760' height='500' frameborder='0' marginheight='0' marginwidth='0'>Loading...</iframe>");
	}
</script>

	<div class="8u skel-cell-mainContent">
		<div id="content">
			<a onclick="changeRoster()">Roster Change Request</a><br />
<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

		$league = $_GET['league'];
		
		//Get teams -> Players -> Stats for each team, builds a table
		
		$getTeams = $mysqli->query("SELECT id, name FROM teams WHERE id > 0 AND division='".$league."' ORDER BY name ASC");
		$createSelect = $mysqli->query("SELECT id, name FROM teams WHERE id > 0 AND division='".$league."' ORDER BY name ASC");
?>
		<select id="selectTeam" onchange="changeTeamDisplayed(this)">
			<option value="NA">All Teams</option>
<?php
		while($team = $createSelect->fetch_row()){
?>
			<option value="<?=$team[0]?>"><?=$team[1]?></option>
<?php
		}
?>
		</select>
<?php
		while ($team = $getTeams->fetch_row()){
			$teamID = $team[0];
			$teamName = $team[1];
		
		$getPlayers = $mysqli->query("SELECT id, summoner, profilePicture, position FROM players WHERE team = ".$teamID." AND disabled = '0'");
?>
		<div id="<?=$teamID?>" class="statsContainer">
		<h3><?=$teamName?></h3>
		<table class="teamStatsTable" width="50%">
			<tr>
				<th>Summoner</th>
				<th>Position</th>
			</tr>
<?php
		while($player = $getPlayers->fetch_row()){
			
?>
			<tr>
				<td><img style="vertical-align: middle" src="<?=$player[2]?>" width="25" height="25px" /> <?=$player[1]?></td>
				<td align="center"><?=$player[3]?></td>
			</tr>
<?php
		}
?>
		</table></div>
<?php
		}
}
else{
?>
	<!-- Content -->
	<p>Please select a league on the left to get the latest news for that league!</p>	
	<!-- Content -->
<?php
}
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="main-wrapper-style3"></div>
</div>
