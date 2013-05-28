<?php include("header.php"); ?>

<script>
//get location if user submits the form

$(document).ready( function(){

$( "input[type=checkbox]" ).on( "click", function() {
	$("input:checked").attr('checked','checked'); //mark as check permanently
});

function submitMoment(){
	$.post($("#moment-form").attr("action"), $("#moment-form").serialize())
	.done( function() {
		window.location="http://192.168.10.2/moments/index.php/member/";
	})
	.fail( function() {
		alert("Failed to post Moment.");
	});
}

$(location_id).change( function(){ $("#location-field").val($(this).val()).change(); } ); //change notifier
$("#location-field").change( submitMoment );

$("#moment-form-submit").click( function(e){
	var tagged_friends = "";
	
	$("input:checked").each(function() { tagged_friends += "," + $(this).val(); });
	
	$("#tagged-friends").val(tagged_friends.substr(1));
	
	fetchUserLocation(); //calculate the lid field
	
	e.preventDefault();
});

});
</script>

<div data-role="content">
	<h4 style="text-align:center;">Share Moment</h4>
	<br />
	<form action="<?php echo site_url('member/submit_moment'); ?>" id="moment-form" method="post" data-ajax="false">
		<input type="text" name="moment_text" placeholder="What's on your mind?" />
		<input type="hidden" name="lid" id="location-field" />
		<input type="hidden" name="mid" value="<?php echo $this->session->flashdata('mid'); ?>" />
		<input type="hidden" name="tagged_friends" id="tagged-friends" value=""/>
		<input type="submit" id="moment-form-submit" value="post" />
	</form>
	<!-- end form -->
	
	<a	href="#popupFriends" 
		data-role="button"
		data-icon="star"
		data-inline="true" 
		data-rel="popup" 
		data-transition="pop"
		data-position-to="window">I'm with</a>
		
	<a href="#" data-role="button" data-inline="true">I'm at</a>
	
	<!-- for i'm with -->
	<div data-role="popup" id="popupFriends" data-theme="a" class="ui-corner-all">
		<form>
			<fieldset data-role="controlgroup">
				<legend><h3>Select Friends</h3></legend>
		
				<?php foreach($friends as $f): ?>
				<label for="<?php echo $f->username; ?>"><?php echo $f->username; ?></label>
			
				<input	type="checkbox" 
						id="<?php echo $f->username; ?>"
						name="<?php echo $f->username; ?>"
						value="<?php echo $f->user_id; ?>" />
				<?php endforeach; ?>	
			</fieldset>
		</form>
    </div>
    <!-- end I'm with -->
</div>

<?php include("footer.php"); ?>
