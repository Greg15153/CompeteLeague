<?php include_once("framework/templates/adminLeftNav.php"); 
	global $context; ?>
	  
	<div class="8u skel-cell-mainContent">
		<div id="content">
		<?php
			if ($context['user']['is_admin']){
		?>
			You're a admin :D!
		<?php
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
