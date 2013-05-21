<!DOCTYPE html> 
<html> 
<head> 
	<title><?php echo $title; ?></title>

	<?php echo link_tag("js/jquery.mobile-1.3.1.min.css"); ?>
	<?php echo link_tag("css/harmony.css"); ?>
	<?php echo link_tag("css/style.css"); ?>
	<?php echo script_tag("js/jquery-1.9.1.min.js"); ?>
	<?php echo script_tag("js/jquery.mobile-1.3.1.min.js"); ?>
	<?php echo script_tag("js/cordova-2.5.0.js"); ?>
	
	<script type="text/javascript" charset="utf-8">
	// Define a click binding for all anchors in the page
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
	
	
	/*Picture notification
	// Wait for Cordova to load
    //
    document.addEventListener("deviceready", onDeviceReady, false);

    // Cordova is ready
    //
    function onDeviceReady() {
        alert("Device Ready.");
    }
	
    function onPrompt(results) {
        alert("You selected button number " + results.buttonIndex + " and entered " + results.input1);
    }
    
    function showPrompt() {
        navigator.notification.prompt(
            'Please enter your name',  // message
            onPrompt,                  // callback to invoke
            'Registration',            // title
            ['Ok','Exit']              // buttonLabels
        );
    }
	//End picture notification */
	
	</script>
	
</head>
<body>
<div data-role="page">
	<div data-role="header"> <!--data-position="fixed"-->
		<h4> Moments </h4>
		<a href="<?php echo site_url('member/index'); ?>" data-icon="home" data-iconpos="notext">Home</a>
			<div data-role="navbar" >
				<ul>
					<li><a href="<?php echo site_url('member/search_friend'); ?>">Friends</a></li>
					<li><a href="#home-notifications">Notifications</a></li>
					<li><a href="#home-search">Search</a></li>
					<li><a href="<?php echo site_url('member/settings'); ?>">Settings</a></li>
				</ul>
			</div>
		<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
	<script>
		$(document).ready(function(){
			if($("#status").length) //hide when empty
				$("#status").hide();
		});
	</script>
	<!-- div id="status" class="info"><?php echo $this->session->flashdata("status"); ?></div -->
