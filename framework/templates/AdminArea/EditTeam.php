<?php
	global $mysqli;
	
	$result = $mysqli->query("SELECT id, name FROM teams WHERE id > 0");
	
    while ($team = $result->fetch_row()){
		$teamName = $team[1];
		$teamID = $team[0];
		
		$getPlayers = $mysqli->query("SELECT summoner FROM players WHERE team = ".$teamID);
		
		echo "<h1>".$teamName."</h1>";
		
		while($player = $getPlayers->fetch_row())
			echo $player[0]."<br/>";
			
		echo "<br />";
	}
?>