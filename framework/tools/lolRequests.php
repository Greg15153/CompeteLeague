<?php
     //Gets HTML data from a data page, USED FOR LOL API -- DO NOT DELETE
    function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
	function contains($needle, $haystack){
		return strpos($haystack, $needle) !== false;	
	}

    function getPlayerID($playerName, $lolKey){
		$playerInfo = get_data("https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$playerName."?api_key=".$lolKey);
		
		if(contains("Not Found", $playerInfo))
			return "Could not find player";
		else{
			if(contains("Rate limit exceeded", $playerInfo)){
				echo $playerInfo."<br />";
				return getPlayerID($playerName, $lolKey);
			}
			else{
				$playerInfo = json_decode($playerInfo, true);
				return $playerInfo[$playerName]["id"];
			}
		}
	}
	
    //Gets ten most recent matches for a player, LoL does not allow you to get 1 game from an ID D:
    function getRecentMatches($playerID, $lolKey){
        $recentMatches = get_data("https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/".$playerID."/recent?api_key=".$lolKey);
        
		if(contains("Rate limit exceeded", $recentMatches))
			return getRecentMatches($playerID, $lolKey);
		else
			return $recentMatches;
    }   
    
    //Gets match id from 10 games with a team -- Doing this so I dont have to run through everyones match list 10 times then do it again to get stats...Time saver...?
    function getGameID($teamList, $lolKey){
        $recentMatches = json_decode(getRecentMatches($teamList[0], $lolKey), true);
        $totalMatches = 0;
		
        for($i=0; $i<count($recentMatches['games']); $i++){
            for($x=0; $x<count($recentMatches['games'][$i]['fellowPlayers']); $x++){
                for($y=1; $y<count($teamList); $y++){
                        if($teamList[$y] == $recentMatches['games'][$i]['fellowPlayers'][$x]['summonerId']){
                            $totalMatches++;
                        }
                }
                if($totalMatches==9)
                    return $recentMatches['games'][$i]['gameId'];
                else
					$problem = true;
            }
        }
        
        return $problem;
    }
    
    //Generate Player Stats -- Gets player stats from a match then submits them to the database
    function generatePlayerStats($player, $playerID, $tableID, $gameID, $lolKey){
        $recentMatches = json_decode(getRecentMatches($player, $lolKey), true);
        
        for($i=0; $i<count($recentMatches['games']); $i++){
            if($recentMatches['games'][$i]['gameId'] == $gameID){
                $champID = $recentMatches['games'][$i]['championId'];
                $kills = $recentMatches['games'][$i]['stats']['championsKilled'];
                $deaths = $recentMatches['games'][$i]['stats']['numDeaths'];
                $assists = $recentMatches['games'][$i]['stats']['assists'];
                $creeps = $recentMatches['games'][$i]['stats']['minionsKilled'];
                $gold = $recentMatches['games'][$i]['stats']['goldEarned'];
                $addStats = "INSERT INTO stats (gameID, playerID, champID, kills, deaths, assists, creeps, gold) VALUES ('".$tableID."', '".$playerID."', '".$champID."', '".$kills."', '".$deaths."', '".$assists."', '".$creeps."', '".$gold."')";
                return $addStats;
            }
            else
                $problem = "Match not Found";
        }
        return $problem;
    }	
?>