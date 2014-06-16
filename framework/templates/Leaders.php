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
	<h3>League Leaders</h3>
	<p>There is currently no content to be put here!</p>	
	<!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<h3>League Leaders</h3>
	<p>There is currently no content to be put here!</p>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<h3>League Leaders</h3>
	<p>There is currently no content to be put here!</p>
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
