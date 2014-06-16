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
	<h3>Silver League Sign Ups</h3>
	<p>Please use the form below to sign up to be a part of the Silver League</p>
	<p>Qualifier tournament will take place <strong>July 12th - July 13th</strong>, from 1pm central - 6pm each day.</p>
	<p>Please note that this tournament is for players Bronze-Silver ranked</p>
	<iframe src="https://docs.google.com/forms/d/18a7cLnrai19MI7HP9y0fkqIj7jV0B3TGPRHGzbnpomI/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
     <!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<h3>Platinum League Sign Ups</h3>
	<p>Please use the form below to sign up to be a part of the Platinum League</p>
	<p>Qualifier tournament will take place <strong>July 19th - July 20th</strong>, from 1pm central - 6pm each day.</p>
	<p>Also note, this tournament is for players ranked Gold-Platinum</p>
	<iframe src="https://docs.google.com/forms/d/18a7cLnrai19MI7HP9y0fkqIj7jV0B3TGPRHGzbnpomI/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<h3>Diamond League Sign Ups</h3>
	<p>Please use the form below to sign up to be a part of the Diamond League</p>
	<p>Qualifier tournament will take place <strong>July 26th - July 27th</strong>, from 1pm central - 6pm each day.</p>
	<p>Please note this tournament is for player Diamond+ ranked</p>
	<iframe src="https://docs.google.com/forms/d/18a7cLnrai19MI7HP9y0fkqIj7jV0B3TGPRHGzbnpomI/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
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
