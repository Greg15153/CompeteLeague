<?php include_once("framework/templates/left-nav.php"); global $mysqli; global $memberContext;?>
<div class="8u skel-cell-mainContent">
	<div id="content">
									
<?php
if(isset($_GET['league']) && ($_GET['league'] == 'Silver' || $_GET['league'] == 'Platinum' || $_GET['league'] == 'Diamond')){

	$league = $_GET['league'];
	
	if(isset($_GET['id'])){
	 // GET NEWS INFORMATION FROM ID
		$getNewsInfo = $mysqli->query("SELECT title, date, poster, article FROM news WHERE id='".$_GET['id']."'");
		
		if($getNewsInfo->num_rows == 0)
			echo "Not found...";
	}
	else{
	 // GET ALL NEWS ARTICLES TO DISPLAY NEWS LIST
	 $getNews = $mysqli->query("SELECT id, title, poster FROM news WHERE section='".$league."' ORDER BY id DESC");
?>
	<center>
		<h3>News Archive</h3>
<?php
	 if($getNews->num_rows == 0)
		echo "No news for this league...";
	else{
?>
	<div id="newsArchiveList">
		<table id="newsArchiveTable" width="50%">
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Poster</th>
			</tr>
<?php	 
	 while ($news = $getNews->fetch_row()){
		loadMemberData($news[2]); 
		loadMemberContext($news[2]);
?>
			<tr>
				<td align="center"><?=$news[0]?></td>
				<td align="center"><a href="?do=News&league=<?=$league?>&id=<?=$news[0]?>"><?=$news[1]?></a></td>
				<td align="center"><a href="http://competeleague.com/clforum/index.php?action=profile;u=<?=$news[2]?>"><?=$memberContext[$news[2]][username]?></a></td>
			</tr>
<?php
	 }}
?>
		</table>
	</div>
	</center>
<?php
	}
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