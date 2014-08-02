<?php include_once("framework/templates/adminLeftNav.php"); 
	global $context; 
	global $user_info;?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		<?php
		$allowed_groups = array(1, 9, 10);
		$allowed = false;
		foreach ($allowed_groups as $allowedGroup)
			if (in_array($allowedGroup, $user_info['groups']))
			{
				$allowed = TRUE;
				break;
			}
			if ($allowed){
				switch($_GET['action']){
					case "AddPlayer" : include_once("framework/templates/AdminArea/AddPlayer.php");break;
					case "RemovePlayer" : include_once("framework/templates/AdminArea/RemovePlayer.php");break;
					case "EditPlayer" : include_once("framework/templates/AdminArea/EditPlayer.php");break;
					case "AddTeam" : include_once("framework/templates/AdminArea/AddTeam.php");break;
					case "EditTeam" : include_once("framework/templates/AdminArea/EditTeam.php");break;
					case "RemoveTeam" : include_once("framework/templates/AdminArea/RemoveTeam.php");break;
					case "AddGame" : include_once("framework/templates/AdminArea/AddGame.php");break;
					case "EditGame" : include_once("framework/templates/AdminArea/EditGame.php");break;
					case "AddNews" : include_once("framework/templates/AdminArea/AddNews.php");break;
					case "EditNews" : include_once("framework/templates/AdminArea/EditNews.php");break;
					default : include_once("framework/templates/AdminArea/landing.php");break;
				}
			}else{
				header('Location: http://www.competeleague.com/index.php?msg=103');
				die();
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
