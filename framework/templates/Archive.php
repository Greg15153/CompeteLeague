<?php include_once("framework/templates/left-nav.php"); ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){
		$league = $_GET['league'];
		
	if($league == 'Silver'){
?>
	<!-- Content - Silver-->
	<p>This is where old articles will go for this league! There is currently no content to be put here.</p>
	<!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<p>This is where old articles will go for this league! There is currently no content to be put here.</p>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<p>This is where old articles will go for this league! There is currently no content to be put here.</p>
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
