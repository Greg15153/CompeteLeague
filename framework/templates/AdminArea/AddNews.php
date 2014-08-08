<style>
.error{
	color: red;
}
</style>
<script>
	function previewPopup(){
		var title = $("#newsAddTitle").val();
		var description = $("#newsAddDescription").val();
		var content = $("#newsAddContent").val();
		var errors = false;
		
		if(title != ""){
			$(".previewTitle").html(title);
			$("#titleErr").html("");
		}
		else{
			$("#titleErr").html("Please insert a title");
			errors = true;
		}
		
		if(description != ""){
			$("#previewDescription").html(description);
			$("#descriptionErr").html("");
		}
		else{
			$("#descriptionErr").html("Please insert a description");
			errors = true;
		}
		
		if(content != ""){
			$("#previewContent").html(content);
			$("#contentErr").html("");
		}
		else{
			$("#contentErr").html("Please insert content");
			errors = true;
		}
		
		if(!errors)
			$("#previewContainer").show();
		else
			$("#previewContainer").hide();
	}
</script>
<div id="addNewsContainer" style="width: 100%;">
	<h3>News Title</h3>
	<input id="newsAddTitle" type="text" placeholder="News Title" style="width: 50%;"/>	<span id="titleErr" class="error"></span>
	
	<h3>News Short-hand description</h3>
	<textarea id="newsAddDescription" placeholder="Insert a description of the whole news article here, keep it short! Please do not insert images" style="width: 100%; min-width: 50%; max-width: 100%; min-height: 100px;"></textarea>
	<span id="descriptionErr" class="error"></span>
	
	<h3>News Content</h3>
	<textarea id="newsAddContent" placeholder="Insert content here including HTML tags" style="width: 100%; min-width: 50%; max-width: 100%; min-height: 300px;"></textarea>
	<span id="contentErr" class="error"></span>
	
	<center><input type="button" value="Preview Article" onclick="previewPopup()"/><input type="submit" value="Submit News Article" /></center>
</div>

<div id="previewContainer" style="display: none;">
	<i>Description Preview</i>
	<div id="previewDescription">
		<h3 class="previewTitle"></h3>
		<p id="previewDescription"></p>
	</div>
	
	<i>Full Article Preview</i>
	<div id="previewArticle">
		<h3 class="previewTitle"></h3>
		<p id="previewContent"></p>
	</div>
</div>
