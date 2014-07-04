<?php include_once("framework/templates/left-nav.php"); ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

		$league = $_GET['league'];
		
	if($league == 'Silver'){
?>
	<!-- Content - Silver-->
	<h3>Silver League Qualifiers</h3>
	<p>Starting on July 12th and ending July 13th at 1pm central</p>
	<iframe src="http://CompeteLeague.challonge.com/SLQ/module" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>     <!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<h3>Platinum League Qualifiers</h3>
	<p>Starting on July 19th and ending July 20th at 1pm central</p>
	<iframe src="http://CompeteLeague.challonge.com/PLQ/module" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<h3>Diamond League Qualifiers</h3>
	<p>Starting on July 26th and ending July 27th at 1pm central</p>
	<iframe src="http://CompeteLeague.challonge.com/DLQ/module" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>	<!-- Content - Diamond -->
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
