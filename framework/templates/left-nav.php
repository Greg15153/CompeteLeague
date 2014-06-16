<body class="left-sidebar">
<?php include_once("framework/templates/nav.php"); ?>
<div id="main-wrapper">
				<div class="main-wrapper-style2">
					<div class="inner">
						<div class="container">
							<div class="row">
								<div class="4u">
									<div id="sidebar">
												<header>
<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

		$league = $_GET['league'];
?>
   <h2><?=$league?> League</h2>
	</header>
	<ul class="style2">
		<li><a href="?do=SignUp&league=<?=$league?>">Sign Up</a></li>
        <li><a href="?do=Info&league=<?=$league?>">Info</a></li>
        <li><a href="?do=Schedule&league=<?=$league?>">Schedule</a></li>
        <li><a href="?do=Stream&league=<?=$league?>">Stream</a></li>
        <li><a href="?do=Stats&league=<?=$league?>">Stats</a></li>
		<li><a href="?do=Leaders&league=<?=$league?>">League Leaders</a></li>
		<li><a href="?do=Standings&league=<?=$league?>">Standings</a></li>
        <li><a href="?do=Roster&league=<?=$league?>">Rosters</a></li>
		<li><a href="?do=Rules&league=<?=$league?>">Rules</a></li>
        <li><a href="?do=Archive&league=<?=$league?>">Archive</a></li>
<?php
	}
	else{
?>
	<h2>Leagues</h2>
	</head>
	<ul class="style2">
		<li><a href="?do=LeagueHome&league=Silver">Silver League</a></li>
		<li><a href="?do=LeagueHome&league=Platinum">Platinum League</a></li>
		<li><a href="?do=LeagueHome&league=Diamond">Diamond League</a></li>
<?php
	}
?>
</ul>
			<footer>
				<a href="?do=" class="button button-icon button-icon-rarrow">Homepage</a>
			</footer>
		</section>
	</div>
</div>