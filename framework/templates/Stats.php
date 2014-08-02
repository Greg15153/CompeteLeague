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
</script>

	<div class="8u skel-cell-mainContent">
		<div id="content">
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
		
		$getPlayers = $mysqli->query("SELECT id, summoner, profilePicture, position FROM players WHERE team = ".$teamID);
?>
		<div id="<?=$teamID?>" class="statsContainer">
		<h3><?=$teamName?></h3>
		<table class="teamStatsTable" width="100%">
			<tr>
				<th>Summoner</th>
				<th>Position</th>
				<th>Total Kills</th>
				<th>Total Deaths</th>
				<th>Total Assists</th>
				<th>Total Creeps</th>
				<th>Total Gold</th>
			</tr>
<?php
		while($player = $getPlayers->fetch_row()){
			$getStats = $mysqli->query("SELECT kills, deaths, assists, creeps, gold FROM stats WHERE playerID = ".$player[0]);
			$kills = 0;
			$deaths = 0;
			$assists = 0;
			$creeps = 0;
			$gold = 0;
			//Adds stats from the pages
			while($stats = $getStats->fetch_row()){
				$kills = $kills+$stats[0];
				$deaths = $deaths+$stats[1];
				$assists = $assists+$stats[2];
				$creeps = $creeps+$stats[3];
				$gold = $gold+$stats[4];	
			}
?>
			<tr>
				<td><img style="vertical-align: middle" src="<?=$player[2]?>" width="25" height="25px" /> <?=$player[1]?></td>
				<td align="center"><?=$player[3]?></td>
				<td align="center"><?=$kills?></td>
				<td align="center"><?=$deaths?></td>
				<td align="center"><?=$assists?></td>
				<td align="center"><?=$creeps?></td>
				<td align="center"><?=$gold?></td>
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
