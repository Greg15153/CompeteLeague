<?php include_once("framework/templates/left-nav.php"); ?>
<div class="8u skel-cell-mainContent">
	<div id="content">
									
<?php
	if(isset($_GET['id'])){
	 // GET NEWS INFORMATION FROM ID
	 
	 echo $_GET['id'];
	}
	else{
	 // GET ALL NEWS ARTICLES TO DISPLAY NEWS LIST
	 
	 echo "News Archive...";
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