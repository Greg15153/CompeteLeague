<?php include_once("framework/templates/adminLeftNav.php"); 
	global $context; ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		<?php
			if ($context['user']['is_admin']){
				switch($_GET['action']){
					case "AddPlayer" : include_once("framework/templates/AdminArea/AddPlayer.php");break;
					case "RemovePlayer" : include_once("framework/templates/AdminArea/RemovePlayer.php");break;
					case "EditPlayer" : include_once("framework/templates/AdminArea/EditPlayer.php");break;
					case "AddTeam" : include_once("framework/templates/AdminArea/AddTeam.php");break;
					case "EditTeam" : include_once("framework/templates/AdminArea/EditTeam.php");break;
					case "RemoveTeam" : include_once("framework/templates/AdminArea/RemoveTeam.php");break;
					case "AddGame" : include_once("framework/templates/AdminArea/AddGame.php");break;
					case "EditGame" : include_once("framework/templates/AdminArea/EditGame.php");break;
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
