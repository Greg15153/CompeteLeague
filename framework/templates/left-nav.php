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
	<!--ADVERTISEMENT-->
   <h2><?=$league?> League</h2>
	</header>
	<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
	<ul class="style2">
		<li><a href="?do=LeagueHome&league=<?=$league?>">Home</a></li>
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
			<br />
			<script type="text/javascript">
			  ( function() {
				if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
				var unit = {"calltype":"async[2]","publisher":"burrow900","width":300,"height":150,"sid":"Chitika Default"};
				var placement_id = window.CHITIKA.units.length;
				window.CHITIKA.units.push(unit);
				document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
			}());
			</script>
			</footer>
		</section>
	</div>
</div>