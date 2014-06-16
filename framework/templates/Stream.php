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
	<object type="application/x-shockwave-flash" height="520px" width="100%" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=competeleague" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel=competeleague&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/competeleague" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from CompeteLeague on www.twitch.tv</a>
	<!-- Content - Silver-->
<?php
	}
	else if($league == 'Platinum'){
?>
	<!--Content - Platinum -->
	<object type="application/x-shockwave-flash" height="520px" width="100%" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=competeleague" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel=competeleague&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/competeleague" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from CompeteLeague on www.twitch.tv</a>
	<!--Content - Platinum -->
<?php
	}
	else if($league == 'Diamond'){
?>
	<!-- Content - Diamond -->
	<object type="application/x-shockwave-flash" height="520px" width="100%" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=competeleague" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel=competeleague&auto_play=true&start_volume=25" /></object><a href="http://www.twitch.tv/competeleague" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px;text-decoration:underline; text-align:center;">Watch live video from CompeteLeague on www.twitch.tv</a>
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
