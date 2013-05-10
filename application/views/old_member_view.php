<!DOCTYPE html> 
<html> 
  <head> 
  <title>Moments</title>
  <!--
  <!--<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />--
  <link rel="stylesheet" href="js/jquery.mobile-1.3.1.min.css" />
  <!--<script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>--
  <script src="js/jquery-1.9.1.min.js"></script>
  <!--<script src="jsmobile/jquery.mobile-1.0.1.min.js"></script>--
  <script src="js/jquery.mobile-1.3.1.min.js"></script>
  <script src="js/media.js"></script>
  <link rel="stylesheet" href="css/style.css">
  -->
  
  <?php echo link_tag("js/jquery.mobile-1.3.1.min.css"); ?>
  <?php echo link_tag("css/style.css"); ?>
  <?php echo script_tag("js/jquery-1.9.1.min.js"); ?>
  <?php echo script_tag("js/jquery.mobile-1.3.1.min.js"); ?>
  
  <?php echo script_tag("js/media.js"); ?>
  
  <script>
  
  </script>
</head> 
<body> 
<!-------------------Home Page Begins ------------------->
<div data-role="page" id="home">
  <div data-role="header" data-position="fixed" data-fullscreen="true">
    <h4> Moments </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
	<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  </div>
  	<h4 style="text-align:center"> Moments </h4>
  	<script>
  	if (!String.prototype.format) {
	  String.prototype.format = function() {
		var args = arguments;
		return this.replace(/{(\d+)}/g, function(match, number) { 
			return typeof args[number] != 'undefined' ? args[number] : match;
		});
	  };
	}
  	
  	$.getJSON("<?php echo site_url('member/get_moments'); ?>", function(res){
		var item = '<li style="margin-bottom:10px;" moment_index={0}> \
					<a href="#comments"><?php echo img("images/asif.jpg"); ?> \
					<h1>{1}</h1> \
					<p>{2}</p>\
					<p class="ui-li-count">{3}</p></a>\
					</li>';
					
		for(i in res){
			$("#moments-ul").append(item.format(i,
												res[i]["username"], 
												res[i]["msg"],
												new Date(res[i]["time"]*1000).toDateString() )
			);
		}
		
  		$("#moments-ul").listview("refresh");
  		
  		/* for updating comments page *********/
  		$("#moments-ul").on("click", ">li", function(){
  			i = $(this).attr("moment_index");
  			
  			var item = '<li style="margin-bottom:10px;"> \
				<a href="#comments"><?php echo img("images/asif.jpg"); ?> \
				<h1>{0}</h1> \
				<p>{1}</p>\
				<p class="ui-li-count">{2}</p></a>';
  	
  			item = item.format(res[i]["username"], res[i]["msg"], new Date(res[i]["time"]*1000).toDateString() );
  			
  			for(c in res[i].comments){
  				var item_c = '<div class="comment" > \
								<?php echo img("images/asif.jpg"); ?> \
								<h1>{0}</h1> \
								<p>{1}</p> \
						  	</div>';
						  	
				item += item_c.format(res[i].comments[c]["username"], res[i].comments[c]["msg"]);
  			}
  			
  			item += "</li>";
  			
  			//alert(item);
  			
  			$("#moment-comments-ul").html(item);
			$("#moment-comments-ul").listview("refresh");
  		});
  	})
  	.fail(function(){ alert("Couldn't retreive moments. Your connection might be down."); });
  	
  	//for moment comments page
  	
  	/*
		<li style="margin-bottom:10px;">
			
			<?php echo img("images/asif.jpg"); ?>
			
			<h1>Asif Niazi</h1>
			<p>next biggest imigration can be from fb to path, just liking it</p>
			<p class="ui-li-count">6m 3s</p>
			
			<div class="comment" >
				<?php echo img("images/asif.jpg"); ?>
				<h1>Hello</h1>
				<p>Hi frients</p>
			</div>
		</li>
  	*/
  	
  	</script>
	<ul id="moments-ul" class="post" data-role="listview" data-filter="true">
		<!--
		<li style="margin-bottom:10px;">
			<a href="#comments"><?php echo img("images/asif.jpg"); ?>
			<h1>Asif Niazi</h1>
			<p>next biggest imigration can be from fb to path, just liking it</p>
			<p class="ui-li-count">6m 3s</p>
			<div class="comments-box">
			<div class="comment" ><?php echo img("images/asif.jpg"); ?>
<h1>Hello</h1><p>Hi frients</p></div>
			<div class="comment"><?php echo img("images/asif.jpg"); ?>
<h1>Hello</h1><p>Hi frients</p></div>
			<div class="comment"><?php echo img("images/asif.jpg"); ?>
<h1>Hello</h1><p>Hi frients</p></div>
</div>
			</a>
		</li>
		<!--
		<li style="margin-bottom:10px;">
			<a href="#"><?php echo img("images/asif.jpg"); ?><?php echo img("images/icons/Music-Library-icon.png"); ?> >
			<h1>Asif Niazi</h1>
			<p>Listening Music</p>
			<p class="ui-li-count">6m 3s</p></a>
		</li>
		-->
	  </ul>
	
  <div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
<!-------------------Home Page Ends ------------------->
<!-------------------Search Music Starts -------------->
<div data-role="page" id="music">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
    <h4> Music </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
	<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  </div>
	<div data-role="content">
		<h4 style="text-align:center;">Music</h4>
		<input id="Searchbox" type="text">
		<button id="Search"  >Search</button>
		<ul id="result">
		</ul>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#movies" data-role="button"><?php echo img("images/icons/bobines-video-icon.png"); ?>>Movies</a></li>
			<li><a href="#books" data-role="button" ><?php echo img("images/icons/Book-icon.png"); ?>>Books</a></li>
		</ul>
	</div>
  </div>

</div>
<!-------------------Search Music Ends -------------->
<!-------------------Search Movies Starts -------------->
<div data-role="page" id="movies">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
    <h4> Movies </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
	<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  </div>
	<div data-role="content">
		<h4 style="text-align:center;">Movies</h4>
		<input id="Searchbox" type="text">
		<button id="Search"  >Search</button>
		<ul id="result">
		</ul>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#movies" data-role="button"><?php echo img("images/icons/bobines-video-icon.png"); ?>>Movies</a></li>
			<li><a href="#books" data-role="button" ><?php echo img("images/icons/Book-icon.png"); ?>>Books</a></li>
		</ul>
	</div>
  </div>

</div>
<!-------------------Search Movies Ends -------------->
<!-------------------Search Books Starts -------------->
<div data-role="page" id="books">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
    <h4> Books </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
	<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  </div>
	<div data-role="content">
		<h4 style="text-align:center;">Movies</h4>
		<input id="Searchbox" type="text">
		<button id="Search"  >Search</button>
		<ul id="result">
		</ul>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#movies" data-role="button"><?php echo img("images/icons/bobines-video-icon.png"); ?>>Movies</a></li>
			<li><a href="#books" data-role="button" ><?php echo img("images/icons/Book-icon.png"); ?>>Books</a></li>
		</ul>
	</div>
  </div>

</div>
<!-------------------Search Books Ends -------------->

<!-------------------Comment Page Starts -------------->
<div data-role="page" id="comments">
  	<div data-role="header" data-fullscreen="true">
	    <h4> Moments </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  	</div>
	<div data-role="content">
	<ul id="moment-comments-ul" class="post" data-role="listview">
		<!--
		<li style="margin-bottom:10px;">
			
			<?php echo img("images/asif.jpg"); ?>
			
			<h1>Asif Niazi</h1>
			<p>next biggest imigration can be from fb to path, just liking it</p>
			<p class="ui-li-count">6m 3s</p>
			
			<div class="comment" >
				<?php echo img("images/asif.jpg"); ?>
				<h1>Hello</h1>
				<p>Hi frients</p>
			</div>
		</li>
		-->
	</ul>
	<form>
		<input type="text" name="comment_text" placeholder="Comment" />
		<input type="submit" value="comment" />
	</form>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
	  	<div data-role="navbar" >
			<ul >
				<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
				<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
				<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
				<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
				<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
			</ul>
		</div>
	</div>
</div>

<!-------------------Comment Page Ends ----------------->
<!-------------------Friends Page Begins ------------------->
<div data-role="page" id="home-friends">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
    <h4> Moments </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
	<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  </div>
	<div data-role="content"> 
	<h4 style="text-align:center;">Friends</h4>
	<div data-role="controlgroup" data-type="horizontal">
	<a href="#" data-role="button" data-theme="b">Friends</a> 
	<a href="#" data-role="button" >Requests</a>
	</div>
	
		<a href="#home-friends-addfriends" data-role="button" data-inline="true">Invite a Friend</a>
		<a href="#home-friends-findfriends" data-role="button" data-inline="true">Find Friends</a>
	
	<ul data-role="listview" data-inset="true">
	<li><a href="#"> Friend Name<p>Tap to Chat friend</p></a> </li>
	<li><a href="#"> Friend Name<p>Tap to Chat friend</p></a> </li>
	<li><a href="#"> Friend Name<p>Tap to Chat friend</p></a> </li>
	<li><a href="#"> Friend Name<p>Tap to Chat friend</p></a> </li>
	<li><a href="#"> Friend Name<p>Tap to Chat friend</p></a> </li>
	</ul>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
 <!-----------------------Friends Page Ends ------------------->
 
 <!-----------------------Add Friends Page Begins ------------->
 <div data-role="page" id="home-friends-addfriends">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4> Add Friends </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
  	<div data-role="content"> 
  		<h4 style="text-align:center"> Friends </h4>
		<form id="form1" method="post">
		<input type="text" name="search" placeholder="Search Moments">
		<input type="submit" value="Search">
		</form>

		<a href="#" >logo1 Contacts<br>
		Add friends from your contacts</a>
		<hr>
		<a href="#">logo2 Facebook<br>
		Add friends from Facebook</a>
		<hr>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
<!--------------------------Add Friend Page Ends ------------------->
<!--------------------------Find Friend Page Begins ------------------->
<div data-role="page" id="home-friends-findfriends">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4> Choose Friends to Invite </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
	<div data-role="content"> 
	<h3 style="text-align:center;">Invite Facebook Friends</h3>
	<p>Connect to find and invite your
	friends from Facebook</p>
	<a href="#" data-role="button" data-inline="true">Connect</a>
	<a href="#home-friends-invite" data-role="button" data-inline="true">No, Thanks</a>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
<!------------------- Find Friend Page Ends ----------------------->
<!-----
<div data-role="page" id="home-notifications-forfriends">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4>Notifications</h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
	<div data-role="content">
	<h4 style="text-align:center">Notifications</h4>
	<div data-role="controlgroup" data-type="horizontal">
	<a href="#home-notifications" data-role="button">For Me</a> 
	<a href="#home-notifications-forfriends" data-role="button" data-theme="b">For Friends</a>
	</div>
	<ul data-role="listview" data-inset="true">
		<li>Data to come</li>
		<li>Data to come</li>
		<li>Data to come</li>
		<li>Data to come</li>
		<li>Data to come</li>
	</ul>
</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
Not in New Version-->

<!-------------------------Notifications ---------------------->
<div data-role="page" id="home-notifications">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4>Notifications</h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
	<div data-role="content">
	<!--<h4 style="text-align:center">Notifications</h4>
	<div data-role="controlgroup" data-type="horizontal">
	<a href="#home-notifications" data-role="button" data-theme="b">For Me</a> 
	<a href="#home-notifications-forfriends" data-role="button">For Friends</a>
	</div>-->
	<h3 style="text-align:center;">Notificaions</h3>
	<ul data-role="listview" data-inset="true">
	<li><h4>Share Moments</h4><p>Moments is for sharing life with loved ones,so
the best place to start is by adding your family. 1 day ago </p>
	
	</li>
	<a href="#" data-role="button">Capture the Moment!</a>
	<li><h4>Import your life</h4><p>You can bring your photos, check-ins and
more from Instagram, Foursquare, or
Facebook to complete your Moments. 4 days ago</p>
	</li>
	<a href="#" data-role="button">Import my life!</a>
	<li><h4>Invite your family</h4><p>Moments is for sharing life with loved ones, so
the best place to start is by adding your family. 5 days ago </p>
	</li>
	<a href="#" data-role="button">Invite my family!</a>
	<li><h6>Adnan Makhani accepted your friend request</h6><p>5 days ago </p>
	</li>
	<a href="#" data-role="button" data-inline="true" data-mini="true">Send Message</a> 
	<a href="#" data-role="button" data-inline="true" data-mini="true" data-theme="b">Suggest Friends</a>



	</ul>
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
<!-----------------------Notifications Page Ends ---------------->

<div data-role="page" id="home-plus_audio_books">
		<div data-role="header">
			<h1>Moments</h1>
  		</div>
		
		<div data-role="content">
			
			<div data-role="controlgroup" data-type="horizontal">
				<div align="left"><a href="#home-plus_audio_music" data-role="button">MUSIC</a> 
				    <a href="#home-plus_audio_movies" data-role="button" >MOVIES</a>
				    <a href="#home-plus_audio_books" data-role="button"data-theme="b">BOOKS</a>
			      </div>
				  
			</div>
			<form>
				<input type="text" placeholder="what are you reading ?" />
			</form>
				<ul data-role="listview" data-inset="true" >
      			      	<li>Fifty Shade of Grey</br></br><p>E L James</p></li>
      					<li>Steve Jobs</br></br><p>Walter Isaacson</p></li>
       					<li>AL-QUR'AN</br></br><p>Unknown</p></li> 
						<li>Fifty Shades Darker </br></br><p>E L James</p></li> 
						<li>The Secret</br></br><p>Rhonda Byrne</p></li> 
 				  </ul>

		</div>
		 
 
 	<div data-role="footer">
		<h4>Moments</h4>
	</div>
    
 </div>
 
<div data-role="page" id="home-plus_audio_music">
		<div data-role="header">
			<h1>Moments</h1>
  		</div>
		
		<div data-role="content">
			
			<div data-role="controlgroup" data-type="horizontal">
				<a href="#home-plus_audio_music"data-role="button" data-theme="b">MUSIC</a> 
				    <a href="#home-plus_audio_movies" data-role="button">MOVIES</a>
				    <a href="#home-plus_audio_books" data-role="button">BOOKS</a>
				  
			</div>
			<form>
			<input type="text" placeholder="what are you listening for ?" />
			</form>
				<ul data-role="listview" data-inset="true" >
      					<a href="#post"><li>Alone<br><br><p>By K-Otic single(2011)</p></li></a>
      					<li>When I Was Your Man</br></br><p>By Bruno mars on Unorthodox jukebox(2012)</li>
       					<li>Mine</br></br>By Kim jae joong on Mine-EP(2013)</p></li> 
						<li>Eternal Flame</br></br><p>By the Bangles on the Essential Bangles(2012) Mine-EP(2013)</p></li> 
						<li>Kau Masih Kekasihku</br></br><p>By NAFF on Isyarat Hati (2006)</p></li> 
 				  </ul>
		</div>
		 
 
 	<div data-role="footer">
		<h4>Moments</h4>
	</div>
    
 </div>
 
<div data-role="page" id="home-plus_audio_movies">
		<div data-role="header">
			<h1>Moments</h1>
  		</div>
		
		<div data-role="content">
			
			<div data-role="controlgroup" data-type="horizontal">
				<div align="left"><a href="#home-plus_audio_music" data-role="button">MUSIC</a> 
				    <a href="#home-plus_audio_movies" data-role="button" data-theme="b">MOVIES</a>
				    <a href="#home-plus_audio_books" data-role="button">BOOKS</a>
			      </div>
				  
			</div>
			<form>
				<input type="text" placeholder="what are you watching?" />
			</form>
				<ul data-role="listview" data-inset="true" >      			
      					<li>Ted</br></br><p>2012</p></li>
      					<li>The Twilight Saga:Breaking Dawn-Part 2</br></br><p>2012</p></li>
       					<li>Skyfall</br></br><p>2012</p></li> 
						<li>The Dark Knight Rises </br></br><p>2012</p></li> 
						<li>Step UP Revolution</br></br><p>2012</p></li> 
 				  </ul>

		</div>
		 
 
 	<div data-role="footer">
		<h4>Moments</h4>
	</div>
    
 </div>
<!---------------Post Page Starts ---------------->

<div data-role="page" id="post">
 
  <div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4>Post</h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>

  <div data-role="content">
  <h4 style="text-align:center;">Thought</h4>
  <form method="post" action="<?php echo site_url('member/submit_moment'); ?>" data-ajax="false">
	  <input type="text" name="moment_text" placeholder="What's on your mind?">
	  <input type="submit" value ="post">
  </form>
  <a href="#im_with" data-role="button" data-inline="true">I'm with</a>
  <a href="#" data-role="button" data-inline="true">I'm at</a>
  </div>
  <div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>

 </div>
<!--------------------Post Page Ends ---------------------->

<!--------------------Im With Starts---------------------->
<div data-role="page" id="im_with">
 	<div data-role="header"  data-fullscreen="true">
	    <h4>Post</h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>  
	<div data-role="content">
	<h3 style="text-align:center;">Gathering</h3>
		<form>
			<input type="text" placeholder="Who are you with?" required>
		</form>
		<ul style="margin-top:10px;" data-role="listview">
			<li><a href="#">Adnan Makhani</a></li>
			<li><a href="#">Adnan Makhani</a></li>
			<li><a href="#">Adnan Makhani</a></li>
			<li><a href="#">Adnan Makhani</a></li>
			<li><a href="#">Adnan Makhani</a></li>
			<li><a href="#">Adnan Makhani</a></li>
			<li><a href="#">Adnan Makhani</a></li>
		</ul>
	</div>
	<div data-role="footer" data-fullscreen="true">
  		<div data-role="navbar" >
			<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
<!---------------Im With Page Ends --------------------->
<!--------------Sleep Page Starts ---------------------->
<div data-role="page" id="plus_moon">
 
  <div data-role="header"  data-fullscreen="true">
	    <h4>Post</h4><a href="#home" data-icon="home" data-iconpos="notext">Sleep</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>  
 
  <div data-role="content"> 
  	<h3>Would you like to go to sleep?</h3>
	<ul data-role="listview">
    <li>Go to Sleep</li>
    <li>I'm Awake</li>
	</ul>
    <br>
    <p><a href="#" data-role="button"> Cancel </a></p> 
	</div>
	<div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>  
</div>
<!--------------Sleep Page Ends ---------------------->

<!--------------Camera Page starts ---------------------->

<div data-role="page" id="plus_photo">
 
  <div data-role="header">
    <h1>Moments</h1>
  </div>
 
  <div data-role="content"> 
    
    <h3>Share Photo</h3>
	<ul data-role="listview">
    <li>Take Photo</li>
    <li>Choose From Gallery</li>
	</ul>
    <br>
    <p><a href="#" data-role="button"> Cancel </a></p> 
	</div>
	<div data-role="footer">
    <h4>Moments</h4>
  </div>  
</div>

<!-------------Camera Page Ends --------------------->
<!---------------Moments Search Page Starts ---------------->
<div data-role="page" id="home-search">
	<div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4>Search Memories</h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
 
  <div data-role="content"> 
  	<h3 style="text-align:center">Search Your Memories</h3>
    <form>
    <input type="text" name="search" placeholder="Search Moments">
    <input type="submit" value ="Search">
    </form>
	

    <h2>Rediscover Your Memories</h2>
    <p>Import your Facebook, Instagram and Foursquare memories to search them easily: </p>

	logo1 logo2  logo 3   </ br>
    <div class="ui-block-b"> <button type="submit" data-theme="a"> Import Memories </button></div>  

 
  </div>
 
  <div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>
</div>
<!-----------------Search Page Ends ------------------------->
<!-----------------Settings Page Begins ------------------------->
<div data-role="page" id="settings">
 
  <div data-role="header" data-position="fixed" data-fullscreen="true">
	    <h4>Settings</h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
	</div>
 
  <div data-role="content"> 
   <h3 style="text-align:center;">Settings</h3>
    <h3> Automatic </h3>

<form>
	<input type="checkbox" name="Neighbourhood" id="Neighbourhood" class="custom" />
       <label for="Neighbourhood"> Neighbourhood </label>
       
	<h4> Me </h4>
	<hr/>

	<input type="submit" value="Set Picture" /> <br />
	<input type="submit" value="Set Cover" /><br />
	<hr />

	<input type="text" placeholder="First Name" name="fname" required value="Tulsi" /><br />
	<input type="text" placeholder="Last Name" name="lname" required value="Das" /><br />
	<input type="text" placeholder="Phone Number" name="number" /><br />
	<input type="text" placeholder="Birthday" name="birthday" required /><br />
    <input type="checkbox" name="Male" id="Male" class="custom" />
    <label for="Male"> Male  </label> 
    <input type="checkbox" name="Female" id="Female" class="custom" />
    <label for="Female"> Female  </label> 
    
    <br />
</form>
	
    <h4>Notifications</h4>
	Friend Requests  <a href="#">mobile icon </a><a href="#">message icon</a><br />
	Posts from Friends  <a href="#">mobile icon </a><a href="#">message icon</a><br />
	Post of Me <a href="#">mobile icon </a><a href="#">  message icon</a><br />
	Comments <a href="#">mobile icon  </a><a href="#">   message icon</a><br />
	Emotions <a href="#">mobile icon  </a><a href="#">   message icon  </a><br />
	Nudges <a href="#"> mobile icon  </a><a href="#">    message icon  </a><br />

   <h4>Sharing</h4>
  
  	Facebook <a href="https://www.facebook.com/">  Connect</a><br />
  	Twitter <a href="https://twitter.com/">  Connect</a><br />
  	Tumblr <a href="http://www.tumblr.com/">  Connect</a><br />
  	Foursquare <a href="https://foursquare.com/">  Connect</a><br />

	 <div class="ui-block-a"> <button type="submit" data-theme="b"> Help </button></div>
     <div class="ui-block-b"> <button type="submit" data-theme="a"> Sign Out </button></div>  
	
  </div>
 
  <div data-role="footer" data-position="fixed" data-fullscreen="true">
  	<div data-role="navbar" >
		<ul >
			<li><a href="#" data-role="button" ><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>>Photos</a></li>
			<li><a href="#" data-role="button"><?php echo img("images/icons/Location-icon.png"); ?>>Location</a></li>
			<li><a href="#music" data-role="button"><?php echo img("images/icons/Music-Library-icon.png"); ?>>Music</a></li>
			<li><a href="#post"  data-role="button"><?php echo img("images/icons/Comment-add-icon.png"); ?>>Comment</a></li>
			<li><a href="#plus_moon" data-role="button" ><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>>Sleep</a></li>
		</ul>
	</div>
  </div>

</div>
<!-----------------Settings Page Ends ------------------------->

</body>
</html>
