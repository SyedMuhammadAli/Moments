<?php include("header.php"); ?>

<script type="text/javascript" charset="utf-8">
    // Wait for Cordova to load
    //
    document.addEventListener("deviceready", onDeviceReady, false);

    // Cordova is ready
    //
    function onDeviceReady() {
    	$.mobile.loading("show");
        navigator.geolocation.getCurrentPosition(onSuccess, onError, { enableHighAccuracy: true });
    }

    // onSuccess Geolocation
    //
    function onSuccess(position) {
    	$.get("http://maps.googleapis.com/maps/api/geocode/json", { latlng: position.coords.latitude + "," + position.coords.longitude, sensor: "true" })
    	.done( function(res){
    		$.post("http://192.168.10.2/moments/index.php/member/check_in", {
    			latitude: position.coords.latitude,
    			longitude: position.coords.longitude,
    			formatted_address: res.results[0].formatted_address,
    			is_posting: true
    		})
    		.done( function(){
    			alert("Checkin saved."); 
    			window.location="http://192.168.10.2/moments/index.php/member/add_moment";
    		})
    		.fail( function(){ alert("Failed to save check in."); } )
    		.always( function(){ $.mobile.loading("hide"); } )
    	})
    	.fail( function(){
    		alert("Failed to get location from Google.");
    		$.mobile.loading("hide"); //only hide early if fails
    	});
    }

    // onError Callback receives a PositionError object
    //
    function onError(error) {
        alert('code: '    + error.code    + '\n' +
                'message: ' + error.message + '\n');
    }

</script>

<body>
    <h3>Computing geolocation...</h3>
</body>
<?php include("footer.php"); ?>
