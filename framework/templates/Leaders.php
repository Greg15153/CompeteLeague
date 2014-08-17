<?php include_once("framework/templates/left-nav.php"); ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){
		$league = $_GET['league'];
		
		//Get teams -> Players -> Stats for each team, builds a table
		
		$topKDA = 0;
		$topKills = 0;
		$topDeaths = 0;
		$topAssists = 0;
		$topCreeps = 0;
		$playerStats = array();
		
		$getTeams = $mysqli->query("SELECT id, name FROM teams WHERE id > 0 AND division='".$league."' ORDER BY name ASC");
		
		while ($team = $getTeams->fetch_row()){
			$teamID = $team[0];
			$teamName = $team[1];
		
		$getPlayers = $mysqli->query("SELECT id, summoner, profilePicture, position FROM players WHERE team = ".$teamID);

			while($player = $getPlayers->fetch_row()){
				$getStats = $mysqli->query("SELECT kills, deaths, assists, creeps FROM stats WHERE playerID = ".$player[0]);
				$kills = 0;
				$deaths = 0;
				$assists = 0;
				$creeps = 0;
				$games = 0;
				
				//Adds stats from the pages
				while($stats = $getStats->fetch_row()){
					$kills = $kills+$stats[0];
					$deaths = $deaths+$stats[1];
					$assists = $assists+$stats[2];
					$creeps = $creeps+$stats[3];
					$games++;
				}
				
				if($games == 0)
					$games=1;
					
				$avgKills = round($kills/$games, 1, PHP_ROUND_HALF_UP);
				$avgDeaths = round($deaths/$games, 1, PHP_ROUND_HALF_UP);
				$avgAssists = round($assists/$games, 1, PHP_ROUND_HALF_UP);
				$avgCreeps = round($creeps/$games, 1, PHP_ROUND_HALF_UP);
				
				if($deaths == 0)
					$KDA = $kills+$assists;
				else
					$KDA = round(($kills+$assists)/$deaths, 1, PHP_ROUND_HALF_UP);
			    // 0      1        2         3        4       5       6     7      8       9        10
				//ID, SUMMONER, PICTURE, POSITION, TEAMID, TEAMNAME, KDA, KILLS, DEATHS, ASSISTS, CREEPS
				$tempArray = array($player[0], $player[1], $player[2], $player[3], $teamID, $teamName, $KDA, $avgKills, $avgDeaths, $avgAssists, $avgCreeps);
				
				if($games >= 3)
					$playerStats[$player[0]] = $tempArray;
			}
		}
		
		$kdaArray = array();
		$killsArray = array();
		$deathsArray = array();
		$assistsArray = array();
		$creepsArray = array();
		
		foreach($playerStats as $player){		
			$kdaArray[$player[0]] = $player[6];
			$killsArray[$player[0]] = $player[7];
			$deathsArray[$player[0]] = $player[8];
			$assistsArray[$player[0]] = $player[9];
			$creepsArray[$player[0]] = $player[10];
		}
		arsort($kdaArray);
		arsort($killsArray);
		arsort($deathsArray);
		arsort($assistsArray);
		arsort($creepsArray);
		
		for($i=0; $i<5; $i++){
			switch($i){
				case 0 : $type = "KDA"; $loc = 6; $array = $kdaArray;break;
				case 1 : $type = "Kills"; $loc = 7; $array = $killsArray;break;
				case 2 : $type = "Deaths"; $loc = 8; $array = $deathsArray;break;
				case 3 : $type = "Assists"; $loc = 9; $array = $assistsArray;break;
				case 4 : $type = "Creeps"; $loc = 10; $array = $creepsArray;break;
			}
			
			$tempKeys = array_keys($array);
			for($x=0; $x<5; $x++){
				//Displays special for #1
				if($x == 0){
?>
					<center>
						<div id="top<?=$type?>">
							<h3>Top <?=$type?></h3>
							<img src="<?=$playerStats[$tempKeys[$x]][2]?>" width="50px" height="50px"/><br />
							<span style="font-size: 20px;"><?=$playerStats[$tempKeys[$x]][1]?></span>
							<table width="50%">
								<tr>
									<th>Team</th>
									<th>Position</th>
									<th><?=$type?></th>
								</tr>
								<tr>
									<td align="center"><?=$playerStats[$tempKeys[$x]][5]?></td>
									<td align="center"><?=$playerStats[$tempKeys[$x]][3]?></td>
									<td align="center"><?=$playerStats[$tempKeys[$x]][$loc]?></td>
								</tr>
							</table>
<?php
				}//Displays list of #2-#5
				else{
?>
				<span><?=$x+1?>. <?=$playerStats[$tempKeys[$x]][1]?> - <?=$playerStats[$tempKeys[$x]][$loc]?></span><br/>
<?php
				}
			}
?>
					</div>
				</center>
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
