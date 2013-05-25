<?php include("header.php"); ?>

<script>
//get location if user submits the form


$(document).ready( function(){

$("#moment-form-submit").click( function(){
	getUserLocation(); //it will submit the form when done
});

});
</script>

<div data-role="content">
	<h4 style="text-align:center;">Thought</h4>
	<br />
	<form id="moment-form" method="post" data-ajax="false">
		<input type="text" name="moment_text" placeholder="What's on your mind?" />
		<input type="hidden" name="lid" id="location-field" />
		<input type="text" name="mid" value="<?php echo $this->session->flashdata('mid'); ?>" />
	</form>
		<input type="submit" id="moment-form-submit" value="post" />
	<!-- end form -->
	
	<a href="#im_with" data-role="button" data-inline="true">I'm with</a>
	<a href="#" data-role="button" data-inline="true">I'm at</a>
</div>

<?php include("footer.php"); ?>
