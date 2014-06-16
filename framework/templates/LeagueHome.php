<?php include_once("framework/templates/left-nav.php");  ?>

<div class="8u skel-cell-mainContent">
	<div id="content">
	
<?php
if(isset($_GET['league'])){
if($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond'){
		$league = $_GET['league'];
		
	if($league == 'Silver'){
?>
	<!-- Content - Silver-->
	<p>Welcome to the registration for <?=$league?> League! Anyone rated Silver and below can sign up with their friends to try their hand at taking home some nice Riot Points for 1st-3rd place. The first thing you must do is register your team (you are allowed substitutes) and we will put your team in a bracket to qualify for our LCS style competition. The top eight teams who qualified will be playing on stream in front of viewers on Tuesday evening and will play two games having their games casted. If you are thinking about smurfing your team will be disqualified we have a very thorough process to identify smurf accounts. </p>
	<p><strong>Qualifiers will be July 12th-13th</strong></p>
     <!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<p>Welcome to the registration for Platinum League! Anyone rated Platinum and below can sign up with their friends to try their hand at taking home some nice Riot Points for 1st-3rd place. The first thing you must do is register your team (you are allowed substitutes) and we will put your team in a bracket to qualify for our LCS style competition. The top eight teams who qualified will be playing on stream in front of viewers on Wednesday evening and will play two games having their games casted. If you are thinking about smurfing your team will be disqualified we have a very thorough process to identify smurf accounts. </p>
	<p><strong>Qualifiers will be July 19th-20th</strong></p>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<p>Welcome to the registration for Diamond League! Anyone rated Challenger and below can sign up with their friends to try their hand at taking home some nice Riot Points for 1st-3rd place. The first thing you must do is register your team (you are allowed substitutes) and we will put your team in a bracket to qualify for our LCS style competition. The top eight teams who qualified will be playing on stream in front of viewers on Thursday evening and will play two games having their games casted.</p>								
	<p><strong>Qualifiers will be July 26th-27th</strong></p>
	<!-- Content - Diamond -->
<?php
	}
}}
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
