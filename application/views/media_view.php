<?php include("header.php"); ?>

<script>
$(document).ready(function(){
	$("#media-search-btn").click(function(){
		$("#result").empty();
		
		$.mobile.loading("show"); //show loading
		$.ajax({
		  url: "https://itunes.apple.com/search",
		  type: "get",
		  data: { term : $("#media-name").val(), entity : $("input[type='radio']:checked").val(), limit: 10},
		  dataType: "jsonp"
		}).done(function( result ) {
			$.mobile.loading("hide"); //hide loading
			var records = result.results;
		
			for(i in records){
				$("#result").append(
				"<li>" +
					"<a href='<?php echo site_url(); ?>" + "/member/add_media/" + records[i].trackId + "' data-ajax='false'>" +
					"<img src=" + records[i].artworkUrl100 + ">" +
					records[i].artistName + "<br/>" + 
					records[i].trackName + "<br/>" +
					"</a>" +
				"</li>" );
			}
			
			$("#result").listview('refresh');
		});
	});
	
	$("#media-search-btn").click(); //for first time load
	$("#media-name").val("");
});

</script>

<div data-role="content">
	<h4 style="text-align:center;">Media</h4>
	
	<fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
		<label for="music">Music</label>
		<input type="radio" id="music" name="media_type" value="musicTrack" checked="checked"/>
		
		<label for="movies">Movies</label>
		<input type="radio" id="movies" name="media_type" value="movie" />
		
		<!-- label for="tvshow">Tv Shows</label>
		<input type="radio" id="tvshow" name="media_type" value="tvShow" /-->
		
		<label for="ebook">Ebook</label>
		<input type="radio" id="ebook" name="media_type" value="ebook" />
	</fieldset>
	
	<input id="media-name" type="text" value="a">
	<button id="media-search-btn">Search</button>

	<ul id="result" data-role="listview" data-inset="true">
		<!-- media added dynamically here
		
		<!-- TEST PHP CODE --
		<?php foreach($media as $m): ?>
		<li>
			<a href="<?php echo site_url(base64_encode(json_encode($m))); ?>">
			<img src="<?php echo $m['artworkUrl100']; ?> ">
			<?php echo $m['artistName'] . "<br />" . $m['trackName'] . "<br />"; ?>
			</a>
		</li>
		<?php endforeach; ?>
		-->
	</ul>
</div>
    
<?php include("footer.php"); ?>
