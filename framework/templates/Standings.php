<script>
function saveContent(contentLoc){
	var content = $("#HTMLContent").val();
	$.post( "framework/tools/ajaxRequests.php", {saveContent : "true", saveContent_location : contentLoc, saveContent_content : content})
				.done(function(data) {
					alert(data);
				});
}
</script>

<?php include_once("framework/templates/left-nav.php"); 
	global $context;
?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		

<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

		$league = $_GET['league'];
	if ($context['user']['is_admin']){ 
?>
	<textarea id="HTMLContent" style="width: 100%; height: 400px;">
<?php
}
	if($league == 'Silver'){
		$contentLoc = "framework/templates/Content/Silver/Standings.html";
		include_once($contentLoc);
	}
	else if($league == 'Platinum'){
		$contentLoc = "framework/templates/Content/Platinum/Standings.html";
		include_once($contentLoc);
	}
	else if($league == 'Diamond'){
		$contentLoc = "framework/templates/Content/Diamond/Standings.html";
		include_once($contentLoc);
	}
	
	if($context['user']['is_admin']){
?>
	</textarea><input type="submit" value="Save Changes" onclick="saveContent('<?=$contentLoc?>')"/>
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

