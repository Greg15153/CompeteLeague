<?php global $mysqli; global $context; global $user_info;?>
<!-- Header Wrapper -->
			<div id="header-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
<!-- Header -->
								<header id="header">
									<div class="inner">
										<!-- Logo -->
											<h1><a href="index.php" id="logo">CompeteLeague</a></h1>
										<!-- Nav -->
										<nav id="nav">
                                            <ul>
                                                <li><a href="?do=LeagueHome&league=Silver">
                                                    <span>Silver League</span></a>
                                                    <ul>
														<li><a href="?do=LeagueHome&league=Silver">Home</a></li>
                                                        <li><a href="?do=Info&league=Silver">Info</a></li>
                                                        <li><a href="?do=Schedule&league=Silver">Schedule</a></li>
                                                        <li><a href="?do=Stream&league=Silver">Stream</a></li>
                                                        <li><a href="?do=Stats&league=Silver">Stats</a></li>
                                                        <li><a href="?do=Leaders&league=Silver">League Leaders</a></li>
                                                        <li><a href="?do=Standings&league=Silver">Standings</a></li>
                                                        <li><a href="?do=Roster&league=Silver">Rosters</a></li>
                                                        <li><a href="?do=Rules&league=Silver">Rules</a></li>
                                                        <li><a href="?do=Archive&league=Silver">Archive</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="?do=LeagueHome&league=Platinum"><span>Platinum League</span></a>
                                                    <ul>
														<li><a href="?do=LeagueHome&league=Platinum">Home</a></li>
                                                        <li><a href="?do=Info&league=Platinum">Info</a></li>
                                                        <li><a href="?do=Schedule&league=Platinum">Schedule</a></li>
                                                        <li><a href="?do=Stream&league=Platinum">Stream</a></li>
                                                        <li><a href="?do=Stats&league=Platinum">Stats</a></li>
                                                        <li><a href="?do=Leaders&league=Platinum">League Leaders</a></li>
                                                        <li><a href="?do=Standings&league=Platinum">Standings</a></li>
                                                        <li><a href="?do=Roster&league=Platinum">Rosters</a></li>
                                                        <li><a href="?do=Rules&league=Platinum">Rules</a></li>
                                                        <li><a href="?do=Archive&league=Platinum">Archive</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="?do=LeagueHome&league=Diamond"><span>Diamond League</span></a>
                                                    <ul>
														<li><a href="?do=LeagueHome&league=Diamond">Home</a></li>
                                                        <li><a href="?do=Info&league=Diamond">Info</a></li>
                                                        <li><a href="?do=Schedule&league=Diamond">Schedule</a></li>
                                                        <li><a href="?do=Stream&league=Diamond">Stream</a></li>
                                                        <li><a href="?do=Stats&league=Diamond">Stats</a></li>
                                                        <li><a href="?do=Leaders&league=Diamond">League Leaders</a></li>
                                                        <li><a href="?do=Standings&league=Diamond">Standings</a></li>
                                                        <li><a href="?do=Roster&league=Diamond">Rosters</a></li>
                                                        <li><a href="?do=Rules&league=Diamond">Rules</a></li>
                                                        <li><a href="?do=Archive&league=Diamond">Archive</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="?do=About">About Us</a></li>
                                                <li><a href="?do=Contact">Contact Us</a>
                                                    <ul>
                                                        <li><a href="?do=Contact&reason=Jobs">Jobs</a></li>
                                                        <li><a href="?do=Contact&reason=Email">Email Us</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="clforum/">Forums</a></li>
                                            </ul>
                                        </nav>
									</div>
									<div id="navLoginContainer">
										<?php
											//If Logged out:
											if ($context['user']['is_guest'])
											{
										?>
										<div id="navLoginContainer"><div id="navLoginBtn" onclick="loginPopup()">Login</div><div id="navRegisterBtn"><a href="http://competeleague.com/clforum/index.php?action=register">Register</a></div></div>
										<div class="ar login_popup">
											<div class="loginPopup">
												<img src="images/closePopup.png" style="float: left;" href="#" class="closePopup" /> 
										<?php
												ssi_login();
										?>
											</div>
										</div>
										
										<?php
											//If logged in:
											}else{
										?>
											<div id="loginWelcome">
											
										<?php
												ssi_welcome();
										?>
											</div>
											<div id="loginLogout">
										<?php
												$allowed_groups = array(1, 9, 10);
												$allowed = false;
												foreach ($allowed_groups as $allowedGroup)
													if (in_array($allowedGroup, $user_info['groups']))
													{
														$allowed = TRUE;
														break;
													}
												if($allowed){
										?>
												<a href="?do=AdminArea">Admin Panel</a> | 
										<?php
												}ssi_logout();
										?>
											</div>
										<?php
											}
										?>
									</div>
										<div id="socialMedia">
											<a href="http://www.reddit.com/r/CompeteLeague" target="_blank"><img src="images/socialMedia/reddit_small.png" /></a>
										</div>
										
										<div class="clear"></div>
		