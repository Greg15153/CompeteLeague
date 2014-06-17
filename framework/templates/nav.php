<?php global $mysqli; ?>
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
                                                        <li><a href="?do=SignUp&league=Silver">Sign Up</a></li>
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
														<li><a href="?do=SignUp&league=Platinum">Sign Up</a></li>
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
														<li><a href="?do=SignUp&league=Diamond">Sign Up</a></li>
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
                                                <li><a href="../clfourm/">Forums</a></li>
                                            </ul>
                                        </nav>
									</div>
																			<?php
										if (login_check($mysqli) == false) {
										?>
											<style>

											</style>
											<div id="navLoginContainer"><div id="navLoginBtn" onclick="loginPopup()"><a>Login</a></div></div>
											<div class="ar login_popup">
										 
											<div class="loginPopup">
												<img src="images/closePopup.png" href="#" class="closePopup" /> 
												<form name="login_form">                      
													<span class="title">Email</span> <input name="email" type="text" />
													<span class="title">Password</span> <input name="password" type="password" />
													<input name="submit" type="button" value="Login" style="float: right" onclick="formhash(this.form.email, this.form.password);"/>
													<input name="submit" type="button" value="Register" style="float: right" onclick="window.location.replace('?do=Register');"/>
												</form>
											</div>
										</div>
										<?php
										}else{
										?>
											<div id="navLoginContainer"><div id="navLoginBtn"><?=$_SESSION['username']?><br /><a onclick="logout()">Logout</a></div></div>
										<?php
											}
										?>

										<div id="socialMedia">
											<a href="http://www.reddit.com/r/CompeteLeague"><img src="images/socialMedia/reddit_small.png" /></a>
										</div>
										
										<div class="clear"></div>
								</header>
						</div>
					</div>
				</div>
			</div>