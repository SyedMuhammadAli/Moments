<?php include("header.php"); ?>

<script>
$(document).ready(function(){
	$("#media-search-btn").click(function(){
		$("#result").empty();
	
		$.ajax({
		  url: "https://itunes.apple.com/search",
		  type: "get",
		  data: { term : $("#media-name").val(), entity : "musicTrack" },
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
					"<hr /> </a>" +
				"</li>" );
			}
			
		});
	});
});
</script>

<div data-role="content">
	<h4 style="text-align:center;">Media</h4>

	<input id="media-name" type="text">
	<button id="media-search-btn">Search</button>

	<ul id="result">
	</ul>
</div>
    
<?php include("footer.php"); ?>
