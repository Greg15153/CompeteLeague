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
        $gameID = getGameID($teamList[0], $teamList, $lolKey);
        $gameExists = $mysqli->query("SELECT * FROM  games WHERE  LoLid=".$gameID);
		echo mysqli_num_rows($gameExists);
        if(mysqli_num_rows($gameExists) == 0){
			$table = $mysqli->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$dbName."' AND   TABLE_NAME   = 'games'");
        
        while ($getID = $table->fetch_row()){
			$tableID = $getID[0];
		}
		
        $queryList = array();
		
        for($i=0; $i<count($teamList); $i++){        
            $addStats = generatePlayerStats($teamList[$i], $teamListID[$i], $tableID, $gameID, $lolKey);
            $mysqli->query($addStats);
            sleep(10);
        }
        
        $mysqli->query("INSERT INTO  games (id, LoLid, season, division, playedDate, team1, team2, win) VALUES ('".$tableID."',  '".$gameID."',  '".$currentSeason."',  '".$division."',  '".$date."',  '".$team1."',  '".$team2."',  '".$winner."')");
        }
        else
            echo "Game Exists";
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
			
			//adds to database
			$addPlayer = $mysqli->query("INSERT INTO players (id,LoLid,summoner,profilePicture,team,position) VALUES (NULL ,  '".$playerID."',  '".$summ."',  '/images/profilePictures/default.gif',  '".$_POST['addPlayer_team']."',  '".$_POST['addPlayer_position']."')");
			if($addPlayer == 1)
				echo "Success";
			else
				echo "Error";
		}
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
		 fwrite($handle, $_POST['saveContent_content']);
		 fclose($handle);
		 echo "Content Saved";
	}
?>