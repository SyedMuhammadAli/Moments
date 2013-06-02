<?php include("header.php"); ?>

<script>

$(document).ready(function(){

$(location_id).change( function(){ $("#location-field").val($(this).val()).change(); } ); //change notifier
$("#location-field").change(function(){
	$("#search-form").submit();
	console.log("Location value changed. Now redirecting...");
});

$("#search-btn").click( function(e){
	console.log("Search-form submitted.");
	fetchUserLocation(); //calculate the lid field

	e.preventDefault(); //doesn't stop event propagation
});

}); //end ready
</script>
<div data-role="content">
	<h4 style="text-align:center;">Search</h4>
	<br />
	<form id="search-form" action="<?php echo site_url('member/search_moments/query');?>" method="post" data-ajax="false">
		<input type="text" name="search_query" placeholder="Search Moments" />
		<input type="text" id="location-field" name="location_id" />
		<input type="submit"  value="Search" id="search-btn" />
	</form>
	<!-- end form -->
	
</div>

<?php include("footer.php"); ?>
