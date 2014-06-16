<?php include_once("framework/templates/left-nav.php"); ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league'])){
if($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond'){
		$league = $_GET['league'];
		
	if($league == 'Silver'){
?>
	<!-- Content - Silver-->
	<h3>Rules</h3>
	<ul>
		<li>All players must be Silver 1 or lower ranked during their first start, players are allowed to rank up after they start in their first game, substitutes are not allowed to rank past Platinum 1 to be eligible</li>
		<li>All players must be registered 24 hours prior to game day (including substitutes)</li>
		<li>All players must be in the lobby within at least 15 minutes of the predetermined start time</li>
		<li>Each team is permitted 10 minutes of pause time</li>
		<li>No foul language or disrespectful trash talk in the pre game lobby, or in all chat, friendly trash talking is permitted however</li>
	</ul>
	<!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<h3>Rules</h3>
	<ul>
		<li>All players must be Platinum 1 or lower ranked during their first start, players are allowed to rank up after they start in their first game, substitutes are not allowed to rank past Platinum 1 to be eligible</li>
		<li>All players must be registered 24 hours prior to game day (including substitutes)</li>
		<li>All players must be in the lobby within at least 15 minutes of the predetermined start time</li>
		<li>Each team is permitted 10 minutes of pause time</li>
		<li>No foul language or disrespectful trash talk in the pre game lobby, or in all chat, friendly trash talking is permitted however</li>
	</ul>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<h3>Rules</h3>
	<ul>
		<li>All players must be registered 24 hours prior to game day (including substitutes)</li>
		<li>All players must be in the lobby within at least 15 minutes of the predetermined start time</li>
		<li>Each team is permitted 10 minutes of pause time</li>
		<li>No foul language or disrespectful trash talk in the pre game lobby, or in all chat, friendly trash talking is permitted however</li>
	</ul>
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
