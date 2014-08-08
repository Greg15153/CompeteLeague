<?php
    include_once("lolRequests.php");
	include_once("../globals.php");
	
	global $mysqli;
    global $currentSeason;
    global $lolKey;
    
    //Gets teams for division for Admin Page - Submit Game
    if(isset($_POST['division'])){
		$division = $_POST['division'];
        $result = '{ "teams" : [';
        $getTeams = $mysqli->query("SELECT id,name FROM teams WHERE season='$currentSeason' AND division='$division' ORDER BY name ASC");
        
		while ($teamInfo = $getTeams->fetch_row()){
           $result = $result.'{ "id" : '.$teamInfo[0].', "name" : "'.$teamInfo[1].'"},';
		}
        $result = $result."]}";
        $result = str_replace_last(",", "", $result);
        echo $result;
    }


    //Gets Team Players for Admin Page - Submit Game
    if(isset($_POST['team'])){
		$team = $_POST['team'];
        $result = '{ "players" : [';
        
        $getPlayers = $mysqli->query("SELECT id,summoner,profilePicture,position,LoLid FROM players WHERE team=$team ORDER BY position ASC");
        
        while ($player = $getPlayers->fetch_row()){
           $result = $result.'{ "id" : '.$player[0].', "summoner" : "'.$player[1].'", "profilePicture" : "'.$player[2].'", "position" : "'.$player[3].'", "LoLid" : "'.$player[4].'"},';
		}
        
        $result = $result."]}";
        $result = str_replace_last(",", "", $result);
        echo $result;
    }
	
	if(isset($_POST['getPlayerInfo'])){
		$playerID = $_POST['getPlayerInfo'];
		
		$getInfo = $mysqli->query("SELECT * FROM players WHERE id=$playerID");
		
		while($playerInfo = $getInfo->fetch_row()){
			$getTeamName = $mysqli->query("SELECT name FROM teams WHERE id=$playerInfo[4]");
			while($teamName = $getTeamName->fetch_row())
				$result = ' { "id" : '.$playerInfo[0].', "LoLid" : "'.$playerInfo[1].'", "summoner" : "'.$playerInfo[2].'", "profilePicture" : "'.$playerInfo[3].'", "teamID" : "'.$playerInfo[4].'", "teamName" : "'.$teamName[0].'", "position" : "'.$playerInfo[5].'"}';
		}
		echo $result;
	}
    
    //Sends an email for Contact Us page
    if(isset($_POST['email'])){
			$email = $_POST['email'];
            $message = $_POST['emailContent'];
            $message = wordwrap($message, 70);
            
            $from = $_POST['from'];
            $subject = "Email from Email Us Page";
            
            // Additional headers
            $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
            
           echo mail($email, $subject, $message, $headers);
           echo $from . $message . $subject . $headers;
    }
    
    
    //Submits a Game to the Game table for page: 
    if(isset($_POST['submitGame'])){
        $team1 = $_POST['SGteam1'];
        $team2 = $_POST['SGteam2'];
        $division = $_POST['SGdivision'];
        $date = $_POST['SGdate'];
        $winner = $_POST['SGwinner'];
        $teamList1 = $_POST['SGteam1Sel'];
        $teamList2 = $_POST['SGteam2Sel'];
        $teamList1ID = $_POST['SGteam1ID'];
        $teamList2ID = $_POST['SGselTeam2ID'];
        
        $teamList = array_merge($teamList1, $teamList2);
        $teamListID = array_merge($teamList1ID, $teamList2ID);

        $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
        $gameID = getGameID($teamList, $lolKey);
		if($gameID == 1)
			echo "Unable to get game ID";
		else{
			$gameExists = $mysqli->query("SELECT * FROM  games WHERE  LoLid=".$gameID);
			if(mysqli_num_rows($gameExists) == 0){
				$table = $mysqli->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$dbName."' AND   TABLE_NAME   = 'games'");
			
			while ($getID = $table->fetch_row()){
				$tableID = $getID[0];
			}
			
			$queryList = array();
			
			for($i=0; $i<count($teamList); $i++){        
				$addStats = generatePlayerStats($teamList[$i], $teamListID[$i], $tableID, $gameID, $lolKey);
				if($addStats == "Match not Found"){
					$problem = true;
				}
				else
					array_push($queryList, $addStats);
			}
				if($problem == true)
					echo "Recent matches failure";
				else{
					array_push($queryList, "INSERT INTO  games (id, LoLid, season, division, playedDate, team1, team2, win) VALUES ('".$tableID."',  '".$gameID."',  '".$currentSeason."',  '".$division."',  '".$date."',  '".$team1."',  '".$team2."',  '".$winner."')");
					foreach($queryList as $query){
						$mysqli->query($query);
					}
					echo "Success";
				}
			}
        else
            echo "Game Exists";
		}
    }
	
	//Returns if name exists, if not returns query statement WITHOUT image. 
	if(isset($_POST['addTeam'])){
		$errors = false;
		
		//checks if team name is already taken
		$result = $mysqli->query("SELECT name FROM teams WHERE  name = '".$_POST['addTeam_name']."' AND division = '".$_POST['addTeam_division']."'");
		//Team Exists
		if(mysqli_num_rows($result) > 0)
			echo "Team Name Exists";
		else{
			echo "Success";
		}
	}
	
	if(isset($_POST['addTeamDatabase'])){
		if(isset($_POST['addTeam_ext']))
			$result = $mysqli->query("INSERT INTO teams (id,name,description,season,division,logo) VALUES (NULL ,  '".$_POST['addTeam_name']."',  '".$_POST['addTeam_desc']."',  '".$currentSeason."',  '".$_POST['addTeam_division']."',  '/images/logos/".$_POST['addTeam_name'].".".$_POST['addTeam_ext']."')");
		else
			$result = $mysqli->query("INSERT INTO teams (id,name,description,season,division,logo) VALUES (NULL ,  '".$_POST['addTeam_name']."',  '".$_POST['addTeam_desc']."',  '".$currentSeason."',  '".$_POST['addTeam_division']."',  '/images/logos/default.gif')");
		echo $result;
	}
	
	//Performs checks and then adds player to database
	if(isset($_POST['addPlayer'])){
		$summ = $_POST['addPlayer_name'];
		//Checks if player name already exists
		$checkPlayer = $mysqli->query("SELECT summoner FROM players WHERE  summoner = '".$summ."'");

		if(mysqli_num_rows($checkPlayer) > 0)
			echo "Player already Exists";
		else{
			$playerName = str_replace(' ', '', $summ);
			$playerID = getPlayerID(strtolower($playerName), $lolKey);
			
			if($playerID == "Could not find player")
				echo "Could not find player";
			else{
			//adds to database
			$addPlayer = $mysqli->query("INSERT INTO players (id,LoLid,summoner,profilePicture,team,position) VALUES (NULL ,  '".$playerID."',  '".$summ."',  '/images/profilePictures/default.gif',  '".$_POST['addPlayer_team']."',  '".$_POST['addPlayer_position']."')");
			if($addPlayer == 1)
				echo "Success";
			else
				echo "Error";
			}
		}
	}
   //Updates a Player in the database
    if(isset($_POST['editPlayer'])){
			$playerID = $_POST['editPlayer_id'];
			$summoner = $_POST['editPlayer_summoner'];
			$position = $_POST['editPlayer_position'];
			$team = $_POST['editPlayer_team'];
			
			//Check if the player name already exists and doesn't have the same ID as we're updating
			$checkPlayer = $mysqli->query("SELECT id FROM players WHERE summoner = '".$summoner."'");
			if(mysqli_num_rows($checkPlayer) > 0 ){
				$checkID = $checkPlayer->fetch_row();
					if($checkID[0] != $playerID)
						$error = "Player already exists";
			}
			
			if($error == ""){
				$tempName = str_replace(' ', '', $summoner);
				$leagueID = getPlayerID(strtolower($tempName), $lolKey);
				if($leagueID == "Could not find player")
					$error = "Could not find player through League API";
				else{
					$mysqli->query("UPDATE players SET summoner='".$summoner."', LoLid='".$leagueID."', team='".$team."', position='".$position."' WHERE id='".$playerID."'");
					echo "Player updated";
				}
			}

			if($error != "")
				echo $error;
    }
	
    //Replaces the Last instance of an item in a string
    function str_replace_last( $search , $replace , $str ) {
        if( ( $pos = strrpos( $str , $search ) ) !== false ) {
            $search_length  = strlen( $search );
            $str    = substr_replace( $str , $replace , $pos , $search_length );
        }
        return $str;
    }
	
	if(isset($_POST['saveContent'])){
		 $handle=fopen("/home/content/69/11835769/html/".$_POST['saveContent_location'], "w");
		 $content = stripslashes($_POST['saveContent_content']);
		 fwrite($handle, $content);
		 fclose($handle);
		 echo "Content Saved";
	}
?>