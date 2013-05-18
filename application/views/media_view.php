<?php include("header.php"); ?>

<script>
$(document).ready(function(){
	$("#media-search-btn").click(function(){
		$("#result").empty();
		
		$.ajax({
		  url: "https://itunes.apple.com/search",
		  type: "get",
		  data: { term : $("#media-name").val(), entity : $("input[type='radio']:checked").val() },
		  dataType: "jsonp"
		}).done(function( result ) {
			var records = result.results;
		
			for(i in records){
				$("#result").append(
				"<li>" +
					"<a href='#'>" +
					records[i].artistName + "<br/>" + 
					records[i].trackName + "<br/>" + 
					records[i].collectionName + "<br/>" + 
					records[i].kind + "<br/>" + 
					"<hr /> </a>" +
				"</li>" );
			}
		});
	});
});
</script>

<div data-role="content">
	<h4 style="text-align:center;">Media</h4>
	
	<fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
		<label for="music">Music</label>
		<input type="radio" id="music" name="media_type" value="musicTrack" />
		
		<label for="movies">Movies</label>
		<input type="radio" id="movies" name="media_type" value="movie" />
		
		<label for="ebook">Ebook</label>
		<input type="radio" id="ebook" name="media_type" value="ebook" />
	</fieldset>
	
	<input id="media-name" type="text">
	<button id="media-search-btn">Search</button>

	<ul id="result">
	</ul>
</div>
    
<?php include("footer.php"); ?>
