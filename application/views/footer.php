	<script type="text/javascript" charset="utf-8">

    var pictureSource;   // picture source
    var destinationType; // sets the format of returned value 

    // Wait for Cordova to connect with the device
    //
    document.addEventListener("deviceready",onDeviceReady,false);

    // Cordova is ready to be used!
    //
    function onDeviceReady() {
        pictureSource=navigator.camera.PictureSourceType;
        destinationType=navigator.camera.DestinationType;
    }

    // Called when a photo is successfully retrieved
    //
    function onPhotoDataSuccess(imageData) {
    	fetchUserLocation();
    	
    	$(location_id).change(function(){
    		//alert("lid:" + $(location_id).val());
    		
    		$.mobile.loading("show"); //show loading for posting moment
    		
    		$.post("<?php echo site_url('member/receive_picture'); ?>", { "picBase64" : "data:image/jpeg;base64,"+imageData, "lid": $(location_id).val() })
			.done( function(res){
				//alert("Image posted. Moment Id: " + JSON.parse(res).moment_id );
				window.location = "<?php echo site_url('member/add_moment/'); ?>" + "?moment_id=" + JSON.parse(res).moment_id;
			})
			.fail( function(){ alert("Failed to save image."); })
			.always( function(){ $.mobile.loading("hide"); });
    	});
    	
    }

    // Called when a photo is successfully retrieved
    //
    function onPhotoURISuccess(imageURI) {
      // Uncomment to view the image file URI 
      // alert(imageURI);

      // Get image handle
      //
      var largeImage = document.getElementById('largeImage');

      // Unhide image elements
      //
      largeImage.style.display = 'block';

      // Show the captured photo
      // The inline CSS rules are used to resize the image
      //
      largeImage.src = imageURI;
    }

    // A button will call this function
    //
    function capturePhoto() {
      // Take picture using device camera and retrieve image as base64-encoded string
      navigator.camera.getPicture(onPhotoDataSuccess, onFail, { quality: 50,
        destinationType: destinationType.DATA_URL });
    }

    // A button will call this function
    //
    function capturePhotoEdit() {
      // Take picture using device camera, allow edit, and retrieve image as base64-encoded string  
      navigator.camera.getPicture(onPhotoDataSuccess, onFail, { quality: 20, allowEdit: true,
        destinationType: destinationType.DATA_URL });
    }

    // A button will call this function
    //
    function getPhoto(source) {
      // Retrieve image file location from specified source
      navigator.camera.getPicture(onPhotoURISuccess, onFail, { quality: 50, 
        destinationType: destinationType.FILE_URI,
        sourceType: source });
    }

    // Called if something bad happens.
    // 
    function onFail(message) {
      alert('Failed because: ' + message);
    }
    
    /* sleep functions */
    function goToBed(is_sleeping){
    	$.mobile.loading("show");
    	
    	fetchUserLocation(); //get updated location
    	
    	$(location_id).change( function(){
    		var moment_text = is_sleeping ? "I'm sleeping now." : "I'm awake.";
    		
    		var moment_object = {
    			"lid" : $(location_id).val(),
    			"mid" : undefined,
    			"tagged_friends" : "",
    			"moment_text" : moment_text
    		}
    		
			$.post("<?php echo site_url('member/submit_moment'); ?>", moment_object)
			.done( function(){ window.location = "<?php echo site_url('member'); ?>"; } )
			.fail( function(){ alert("Failed."); } )
			.always( function(){ $.mobile.loading("hide"); } );
    	});
    }
    /* end sleep functions */
    
    </script>
  
  <!--
    <button onclick="capturePhoto();">Capture Photo</button> <br>
    <button onclick="capturePhotoEdit();">Capture Editable Photo</button> <br>
    <button onclick="getPhoto(pictureSource.PHOTOLIBRARY);">From Photo Library</button><br>
    <button onclick="getPhoto(pictureSource.SAVEDPHOTOALBUM);">From Photo Album</button><br>
  -->
  
	<div data-role="popup" id="picture-dialog" class="ui-content">
		<h4>Share Photos</h4>
		<button onclick="capturePhoto();">Take a Photo</button>
		<button onclick="getPhoto(pictureSource.SAVEDPHOTOALBUM);">Share from Gallery</button>
		<span style="padding: 5px 100px;"><span>
		<a href="#" data-rel="back" data-role="button"> Cancel </a>
	</div>
	
	<div data-role="popup" id="sleep-dialog" class="ui-content">
		<h4>Would you like to go to sleep?</h4>
		<a href="#" onclick="goToBed(true)" data-role="button">Go to Sleep</a>
		<a href="#" onclick="goToBed(false)" data-role="button">I'm Awake</a>
		<span style="padding: 5px 100px;"><span>
		<a href="#" data-rel="back" data-role="button"> Cancel </a>
	</div>
    
	<!--data-position="fixed" removed. Inline styles fix the flickering issue -->
	<div id="footer-menu" data-role="footer" style="bottom:0;width:100%" data-position="fixed">
	 	<?php //echo "Loaded in: " . $this->benchmark->elapsed_time();?>
	 	<div data-role="navbar" >
	 		</style>
			<ul id="footer-nav">
				<li><a href="#picture-dialog" id="pic-dialog-link" data-rel="popup" data-position-to="window" data-transition="pop"><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>Pictures</a></li>
				<li><a href="<?php echo site_url('member/messages'); ?>"><?php echo img("images/icons/Location-icon.png"); ?>Messages</a></li>
				<li><a href="<?php echo site_url('member/search_media'); ?>"><?php echo img("images/icons/Music-Library-icon.png"); ?>Media</a></li>
				<li><a href="<?php echo site_url('member/add_moment'); ?>" ><?php echo img("images/icons/Comment-add-icon.png"); ?>Moment</a></li>
				<li><a href="#sleep-dialog" data-rel="popup" data-position-to="window" data-transition="pop"><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>Sleep</a></li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>
