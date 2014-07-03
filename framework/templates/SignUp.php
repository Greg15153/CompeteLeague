<?php include_once("framework/templates/left-nav.php"); ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

		$league = $_GET['league'];
		
	if($league == 'Silver'){
?>
	<!-- Content - Silver-->
	<h3>Silver League Sign Ups</h3>
	<p>Silver League sign ups have ended for this season, please tune-in to the live stream on July 12th and 13th at 1pm central <a href="?do=Stream&league=Silver">here!</a></p>
     <!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<h3>Platinum League Sign Ups</h3>
	<p>Platinum League sign ups have ended for this season, please tune-in to the live stream on July 19th and 20th at 1pm central <a href="?do=Stream&league=Platinum">here!</a></p>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<h3>Diamond League Sign Ups</h3>
	<p>Diamond League sign ups have ended for this season, please tune-in to the live stream on July 26th and 27th at 1pm central <a href="?do=Stream&league=Diamond">here!</a></p>
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
