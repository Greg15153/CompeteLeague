<?php include_once("framework/templates/left-nav.php"); ?>
<div class="8u skel-cell-mainContent">
	<div id="content">
									
<?php
	if(isset($_GET['reason'])){
	if($_GET['reason'] == 'Jobs'){
?>		
		<!-- Jobs content -->
		<center>
		<h3>Sign up to be a part of the CompeteLeague Staff!</h3>
		<iframe src="https://docs.google.com/forms/d/1ZSVOVCSXjgQcgfdEPPapE6e2mXrnjkE_BQr9emVSju8/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
		</center>
		<!-- Jobs content -->
<?php
	}
	else if($_GET['reason'] == 'Email'){
?>
	<!-- Contact content -->
	<h2>Email Us</h2>
	<span id='hiddenSelect' style="color: red; display: none;">Please select a Staff Member <br /></span>
    <label>Our Staff<select id="emailList">
		<option value="NA">Select Email</option>
		<option value="lolshock@competeleague.com">CompeteLeague</option>
		<option value="lolshock@competeleague.com">CL Lolshock</option>
    </select></label>
    <br /><br />
	<span id="hiddenContent" style="color: red; display: none;">Please let us know what your problem is!<br /></span>
	What can we help you with?
	<br />
	<textarea id='emailContent' style="width: 500px; height: 100px;"></textarea>
	<br /><br />
	<span id="hiddenEmail" style='color: red; display: none;'>Please insert a valid email address<br /></span>
	<label>Your Email: <input id="fromEmail" type="text" /></label>
	<br /><br />
	<input type="submit" value="Submit" onclick="sendEmail()" />
	<!-- Contact content -->
<?php
	}}
	else{
?>
	<!-- Default content -->
	<p>If you are interested in a Job, found a problem with the site, or just want to ask a question please use the following forms to contact us below!</p>
	<p><a href="?do=Contact&reason=Jobs">Jobs</a></p>
	<p><a href="?do=Contact&reason=Email">Contact Us</a></p>
	<!-- Default content -->
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