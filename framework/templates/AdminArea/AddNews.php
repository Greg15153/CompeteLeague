<style>
.error{
	color: red;
}
</style>
<script>
	function previewPopup(){
		var errors = errorCheck();
		var section = $("#section").val();
		var title = $("#newsAddTitle").val();
		var description = $("#newsAddDescription").val();
		var content = $("#newsAddContent").val();
		
		
		if(!errors){
			$(".previewTitle").html(title);
			$("#previewDesc").html(description);
			$("#previewContent").html(content);
			$("#previewContainer").show();
		}
		else{
			$("#previewContainer").hide();
		}
	}
	
	function submitArticle(){
		errors = errorCheck();
		var section = $("#section").val();
		var poster = $("#poster").val();
		var title = $("#newsAddTitle").val();
		var description = $("#newsAddDescription").val();
		var content = $("#newsAddContent").val();
		
		if(!errors){
			$.post( "framework/tools/ajaxRequests.php", {submitArticle : "true", submitArticle_section : section, submitArticle_poster : poster, submitArticle_title : title, submitArticle_description : description, submitArticle_content : content})
				.done(function(data) {
					alert(data);
				});
		}
	}
	function errorCheck(){
		var section = $("#section").val();
		var title = $("#newsAddTitle").val();
		var description = $("#newsAddDescription").val();
		var content = $("#newsAddContent").val();
		var poster = $("#poster").val();
		var errors = false;
		
		if(section == "NA"){
			$("#sectionErr").html("Please insert a Section");
			errors = true;
		}
		else
			$("#sectionErr").html("");
			
		if(poster == ""){
			$("#posterErr").html("Please insert a poster ID, obtained from user ID on forums");
			errors = true;
		}
		else
			$("#posterErr").html("");
			
		if(title == ""){
			$("#titleErr").html("Please insert a title");
			errors = true;
		}
		else
			$("#titleErr").html("");
			
		if(description == ""){
			$("#descriptionErr").html("Please insert a description");
			errors = true;
		}
		else
			$("#descriptionErr").html("");
			
		if(content == ""){
			$("#contentErr").html("Please insert content");
			errors = true;
		}
		else
			$("#contentErr").html("");
		
		return errors;
	}
	
	function checkID(){
		$.post( "framework/tools/ajaxRequests.php", {getMemberInfo : 'true', getMemberInfo_id : $("#poster").val()})
			.done(function(data) {
				alert(data);
			});
	}
</script>

<div id="addNewsContainer" style="width: 100%;">
	<select id="section">
		<option value="NA">Select Section</option>
		<option value="General">General</option>
		<option value="Silver">Silver</option>
		<option value="Diamond">Diamond</option>
		<option value="Platinum">Platinum</option>
	</select><span id="sectionErr" class="error"></span>
	<br />
	<label>Poster ID <input id="poster" type='number' value='<?=$user_info['id']?>' style="width: 50px;" /></label><input onclick="checkID()" type="submit" value="Check ID" /><span id="posterErr" class="error"></span>
	<h3>News Title</h3>
	<input id="newsAddTitle" type="text" placeholder="News Title" style="width: 50%;"/>	<span id="titleErr" class="error"></span>
	
	<h3>News Short-hand description</h3>
	<textarea id="newsAddDescription" placeholder="Insert a description of the whole news article here, keep it short! Please do not insert images" style="width: 100%; min-width: 50%; max-width: 100%; min-height: 100px;"></textarea>
	<span id="descriptionErr" class="error"></span>
	
	<h3>News Content</h3>
	<textarea id="newsAddContent" placeholder="Insert content here including HTML tags" style="width: 100%; min-width: 50%; max-width: 100%; min-height: 300px;"></textarea>
	<span id="contentErr" class="error"></span>
	
	<center><input type="button" value="Preview Article" onclick="previewPopup()"/><input type="submit" value="Submit News Article" onclick="submitArticle()"/></center>
</div>
<div id="previewContainer" style="display: none;">
	<i>Description Preview</i>
	<div id="previewDescription">
		<h3 class="previewTitle"></h3>
		<p id="previewDesc"></p>
	</div>
	<hr>
	<i>Full Article Preview</i>
	<div id="previewArticle">
		<h3 class="previewTitle"></h3>
		<p id="previewContent"></p>
	</div>
</div>

