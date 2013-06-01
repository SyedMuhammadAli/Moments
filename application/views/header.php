<!DOCTYPE html> 
<html> 
<head> 
	<title><?php echo $title; ?></title>

	<?php echo link_tag("js/jquery.mobile-1.3.1.min.css"); ?>
	<?php echo link_tag("css/{$this->session->userdata('theme')}.css"); ?>
	<?php echo link_tag("css/style.css"); ?>
	<?php echo script_tag("js/jquery-1.9.1.min.js"); ?>
	<?php echo script_tag("js/jquery.mobile-1.3.1.min.js"); ?>
	<?php echo script_tag("js/cordova-2.5.0.js"); ?>
	
	<script type="text/javascript" charset="utf-8">
	
	/*/ Define a click binding for all anchors in the page
	$( "a" ).on( "click", function( event ){

	  // Prevent the usual navigation behavior
	  event.preventDefault();

	  // Alter the url according to the anchor's href attribute, and
	  // store the data-foo attribute information with the url
	  $.mobile.navigate( this.attr( "href" ), {
		foo: this.attr("data-foo")
	  });

	  // Hypothetical content alteration based on the url. E.g, make
	  // an AJAX request for JSON data and render a template into the page.
	  alterContent( this.attr("href") );
	});
	*/
	
	// Wait for Cordova to load
    document.addEventListener("deviceready", onDeviceReady, false);

    // Cordova is ready
    //
    function onDeviceReady() {
    	//pass
    }
    
    /* Generic location function */
    (function(){
		location_id = document.createElement("input");
		location_id.setAttribute("type", "hidden");
		location_id.setAttribute("name", "location_id");
		location_id.setAttribute("value", "undefined");
    })(); //create location element for Global Namespace 
    
    function fetchUserLocation(){
    	$.mobile.loading("show");
		navigator.geolocation.getCurrentPosition( fetchLocationSuccess, fetchLocationError, { enableHighAccuracy: true });
    }
    
    function fetchLocationSuccess(position){
    	$.get("http://maps.googleapis.com/maps/api/geocode/json", { latlng: position.coords.latitude + "," + position.coords.longitude, sensor: "true" })
    	.done( function(location_name){ updateLocationId(location_name, position); } )
    	.fail( function(){ alert("Failed to get location from Google."); })
    	.always( function(){ $.mobile.loading("hide"); } );
    }
    
    function fetchLocationError(error){
    	alert('Message: ' + error.message + '\n' + 'Code: ' + error.code);
    }
    
    function updateLocationId(location_names, position){
    	$.mobile.loading("show");
    	
    	$.post("<?php echo site_url('member/check_in'); ?>", {
    		latitude: position.coords.latitude,
    		longitude: position.coords.longitude,
    		formatted_address: location_names.results[0].formatted_address,
    		is_posting: true
    	})
    	.done( function(res){
    		//expilicitly mark change since value change programatically does not fire event
    		$(location_id).val( JSON.parse(res).lid ).change();
    	})
    	.fail( function(){
    		alert("Failed to save location.");
    	})
    	.always( function(){
    		$.mobile.loading("hide");
    	});
    }
    /* End location function */
	</script>
	
</head>
<body>
<div data-role="page">
	<div data-role="header"> <!--data-position="fixed"-->
		<h4 style="padding:0px; margin:0 auto;"><?php echo img('images/icons/logo.png');?></h4>
		<a href="<?php echo site_url('member/index'); ?>" data-icon="home" data-iconpos="notext">Home</a>
			<div data-role="navbar" >
				<ul>
					<li><a href="<?php echo site_url('member/search_friend'); ?>">Friends</a></li>
					<li><a href="<?php echo site_url('member/notifications'); ?>">Notifications</a></li>
					<li><a href="#home-search">Find Moments</a></li>
					<li><a href="<?php echo site_url('member/settings'); ?>">Settings</a></li>
				</ul>
			</div>
		<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
	<!-- div id="status" class="info"><?php echo $this->session->flashdata("status"); ?></div -->
