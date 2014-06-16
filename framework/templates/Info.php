<?php include_once("framework/templates/left-nav.php"); ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

		$league = $_GET['league'];
		
	if($league == 'Silver'){
?>
	<!-- Content - Silver-->
	<h3>Silver League Info</h3>
	<ul>
	<li>Games are played from 5-9pm central time on Tuesdays</li>
	<li>Games are eligible to be rescheduled so long as an organizer is alerted, and the set time is agreeable for both teams involved. If it is a game that is set to be streamed, must be confirmed 24 hours before the stream. (must be confirmed by an organizer)</li>
	<li>8 teams are involved</li>
	<li>Each team will play the others twice a season</li>
	<li>Each team will play two games a week</li>
	</ul>
	<!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<h3>Platinum League Info</h3>
	<ul>
	<li>Games are played from 5-9pm central time on Wednesdays</li>
	<li>Games are eligible to be rescheduled so long as an organizer is alerted, and the set time is agreeable for both teams involved. If it is a game that is set to be streamed, must be confirmed 24 hours before the stream. (must be confirmed by an organizer)</li>
	<li>8 teams are involved</li>
	<li>Each team will play the others twice a season</li>
	<li>Each team will play two games a week</li>
	</ul>	
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<h3>Diamond League Info</h3>
	<ul>
	<li>Games are played from 5-9pm central time on Thursdays</li>
	<li>Games are eligible to be rescheduled so long as an organizer is alerted, and the set time is agreeable for both teams involved. If it is a game that is set to be streamed, must be confirmed 24 hours before the stream. (must be confirmed by an organizer)</li>
	<li>8 teams are involved</li>
	<li>Each team will play the others twice a season</li>
	<li>Each team will play two games a week</li>
	</ul>	
	<!-- Content - Diamond -->
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
