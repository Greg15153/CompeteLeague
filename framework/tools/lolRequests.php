<?php
	include_once("logger.php");
	
     //Gets HTML data from a data page, USED FOR LOL API -- DO NOT DELETE
    function get_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
		echo $data;
        return $data;
    }
	function contains($needle, $haystack){
		return strpos($haystack, $needle) !== false;	
	}

    function getPlayerID($playerName, $lolKey){
		$file = "logs/LOG - getPlayerID.txt";
		$logger = new logger();
		$content = $logger->getContent($file);
		
		$playerInfo = get_data("https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/".$playerName."?api_key=".$lolKey);
				
		$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Starting pull - $playerName");
		
		if(contains("Not Found", $playerInfo)){
			$content .= $logger->addLog($file, $content, $logger->getDate(), "WARN", "KEY: $lolKey :: Player not found - $playerName");
			$logger->saveLog($file, $content);
			return "Could not find player";
		}
		else{
			if(contains("Rate limit exceeded", $playerInfo)){
				echo $playerInfo."<br />";
				
				$content .= $logger->addLog($file, $content, $logger->getDate(), "WARN", "KEY: $lolKey :: Rate Limit Exceeded - $playerName");
				$logger->saveLog($file, $content);
				
				return getPlayerID($playerName, $lolKey);
			}
			elseif(contains("Missing api key", $playerInfo)){
				$content .= $logger->addLog($file, $content, $logger->getDate(), "WARN", "KEY: $lolKey :: No API key found - $playerName");
				$logger->saveLog($file, $content);
				return;
			}
			else{
				$playerInfo = json_decode($playerInfo, true);
				
				$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Successfully got playerID - $playerName - ".$playerInfo[$playerName]["id"]);
				$logger->saveLog($file, $content);
				
				return $playerInfo[$playerName]["id"];
			}
		}
	}
	
    //Gets ten most recent matches for a player, LoL does not allow you to get 1 game from an ID D:
    function getRecentMatches($playerID, $lolKey){
        $file = "logs/LOG - getRecentMatches.txt";
		$dumpFile = "LOG - recentMatchesDump.txt";
		$logger = new logger();
		$content = $logger->getContent($file);
		$dumpContent = $logger->getContent($dumpFile);
		
		$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Starting pull - $playerID");
		$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "INFO", "START OF RECENT MATCH FOR: $playerID");
		$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "SPACE", "");
		
		$recentMatches = get_data("https://na.api.pvp.net/api/lol/na/v1.3/game/by-summoner/".$playerID."/recent?api_key=".$lolKey);
        
		if(contains("Not Found", $recentMatches)){
			$content .= $logger->addLog($file, $content, $logger->getDate(), "WARN", "KEY: $lolKey :: Player not found - $playerID");
			$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "WARN", "Player not found");

			$logger->saveLog($file, $content);
			$logger->saveLog($dumpFile, $dumpContent);
			return "Could not find player";
		}
		else{
			if(contains("Rate limit exceeded", $recentMatches)){
				$content .= $logger->addLog($file, $content, $logger->getDate(), "WARN", "KEY: $lolKey :: Rate Limit Exceeded - $playerID");
				$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "WARN", "Rate Limit Exceeded");
				$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "SPACE", "");

				$logger->saveLog($file, $content);
				$logger->saveLog($dumpFile, $dumpContent);
				
				return getRecentMatches($playerID, $lolKey);	
			}
			else{
				$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Successfully pulled player matches - $playerID");
				$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "MATCH", $recentMatches);
				$dumpContent .= $logger->addLog($dumpFile, $dumpContent, $logger->getDate(), "END", "");

				$logger->saveLog($file, $content);
				$logger->saveLog($dumpFile, $dumpContent);

				return $recentMatches;
			}
		}
    }   
    
    //Gets match id from 10 games with a team -- Doing this so I dont have to run through everyones match list 10 times then do it again to get stats...Time saver...?
    function getGameID($teamList, $lolKey){
        $file = "logs/LOG - getGameID.txt";
		$logger = new logger();
		$content = $logger->getContent($file);
		
		$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Performing getRecentMatches on - ".$teamList[0]);

		$recentMatches = json_decode(getRecentMatches($teamList[0], $lolKey), true);
        $totalMatches = 0;
		
        for($i=0; $i<count($recentMatches['games']); $i++){
            for($x=0; $x<count($recentMatches['games'][$i]['fellowPlayers']); $x++){
                for($y=1; $y<count($teamList); $y++){
                        if($teamList[$y] == $recentMatches['games'][$i]['fellowPlayers'][$x]['summonerId']){
							$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Found fellow player: ".$recentMatches['games'][$i]['fellowPlayers'][$x]['summonerId']." in game match: ".$recentMatches['games'][$i]['gameId']);
                            $totalMatches++;
                        }
                }
                if($totalMatches==9){
					$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Game ID found: ".$recentMatches['games'][$i]['gameId']);
					$logger->saveLog($file, $content);
                    return $recentMatches['games'][$i]['gameId'];
				}
                else
					$problem = true;
            }
        }
		for($i=0; $i<count($teamList); $i++){
			$team .= $teamList[$i] . ", ";
		}
        $content .= $logger->addLog($file, $content, $logger->getDate(), "WARN", "KEY: $lolKey :: Could not find GameID for Team list: ".$team);
		$logger->saveLog($file, $content);
        return $problem;
    }
    
    //Generate Player Stats -- Gets player stats from a match then submits them to the database
    function generatePlayerStats($player, $playerID, $tableID, $gameID, $lolKey){
	    $file = "logs/LOG - generatePlayerStats.txt";
		$logger = new logger();
		$content = $logger->getContent($file);
		
		$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Performing getRecentMatches on NAME: ".$player." LoLID: ".$playerID." SQL ID: ".$tableID." with gameID: ".$gameID);
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
				
				$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Successfully gathered stats SQL: ".$addStats);
				$logger->saveLog($file, $content);
				return $addStats;
            }
            else
                $problem = "Match not Found";
        }
		$content .= $logger->addLog($file, $content, $logger->getDate(), "INFO", "KEY: $lolKey :: Match not found for NAME: ".$player." LoLID: ".$playerID);
		$logger->saveLog($file, $content);

        return $problem;
    }		
?>