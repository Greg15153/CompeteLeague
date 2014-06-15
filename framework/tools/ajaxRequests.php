<?php
    include_once("../globals.php");
    include_once("lolRequests.php");
    global $seasonSQL;
    global $currentSeason;
    global $lolKey;
    
    $division = $_POST['division'];
    $email = $_POST['email'];
    $team = $_POST['team'];
    $submitGame = $_POST['submitGame'];


    //Gets teams for division for Admin Page - Submit Game
    if($division != null){         
        $result = '{ "teams" : [';
        $getTeams = $seasonSQL->getArray("SELECT id,name FROM teams WHERE season='$currentSeason' AND division='$division' ORDER BY name ASC");
       
        foreach($getTeams as $teamInfo)
           $result = $result.'{ "id" : '.$teamInfo['id'].', "name" : "'.$teamInfo['name'].'"},';
        
        $result = $result."]}";
        $result = str_replace_last(",", "", $result);
        echo $result;
    }


    //Gets Team Players for Admin Page - Submit Game
    if($team != null){
        $result = '{ "players" : [';
        
        $getPlayers = $seasonSQL->getArray("SELECT id,LoLid, summoner,profilePicture,position FROM players WHERE team=$team ORDER BY position ASC");
        
        foreach($getPlayers as $player)
           $result = $result.'{ "id" : '.$player['id'].', "summoner" : "'.$player['summoner'].'", "profilePicture" : "'.$player['profilePicture'].'", "position" : "'.$player['position'].'", "LoLid" : "'.$player['LoLid'].'"},';
        
        $result = $result."]}";
        $result = str_replace_last(",", "", $result);
        echo $result;
    }
    
    //Sends an email for Contact Us page
    if($email != null){
            $message = $_POST['emailContent'];
            $message = wordwrap($message, 70);
            
            $from = $_POST['from'];
            $subject = "Email from Email Us Page";
            
            // Additional headers
            $headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
            
           echo mail($email, $subject, $message, $headers);
           echo $from . $message . $subject . $headers;
    }
    
    
    //Submits a Game to the Game table for page: /AdminArea/submitGame.php
    if($submitGame != null){
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
        
        $gameExists = $seasonSQL->getArray("SELECT * FROM  games WHERE  LoLid=".$gameID);
        if(count($gameExists) == 0){
        $tableID = $seasonSQL->getArray("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$dbName."' AND   TABLE_NAME   = 'games'");
        
        $queryList = array();
        
        for($i=0; $i<count($teamList); $i++){        
            $addStats = generatePlayerStats($teamList[$i], $teamListID[$i], $tableID[0]['AUTO_INCREMENT'], $gameID, $lolKey);
            $seasonSQL->query($addStats);
            sleep(10);
        }
        
        $seasonSQL->query("INSERT INTO  games (id, LoLid, season, division, playedDate, team1, team2, win) VALUES ('".$tableID[0]['AUTO_INCREMENT']."',  '".$gameID."',  '".$currentSeason."',  '".$division."',  '".$date."',  '".$team1."',  '".$team2."',  '".$winner."')");
        }
        else
            echo "Game Exists";
    }
    
    //Replaces the Last instance of an item in a string
    function str_replace_last( $search , $replace , $str ) {
        if( ( $pos = strrpos( $str , $search ) ) !== false ) {
            $search_length  = strlen( $search );
            $str    = substr_replace( $str , $replace , $pos , $search_length );
        }
        return $str;
    }
    
?>