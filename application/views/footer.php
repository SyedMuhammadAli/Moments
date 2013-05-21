	<div data-role="popup" id="picture-dialog" class="ui-content">
		<h4>Share Photos</h4>
		<a href="#" data-role="button">Take a Photo</a>
		<a href="#" data-role="button">Share from Gallery</a>
		<span style="padding: 5px 100px;"><span>
		<a href="#" data-rel="back" data-role="button"> Cancel </a>
	</div>
	
	<div data-role="popup" id="sleep-dialog" class="ui-content">
		<h4>Would you like to go to sleep?</h4>
		<a href="<?php echo site_url('member/go_to_sleep/sleep'); ?>" data-role="button">Go to Sleep</a>
		<a href="<?php echo site_url('member/go_to_sleep/awake'); ?>" data-role="button">I'm Awake</a>
		<span style="padding: 5px 100px;"><span>
		<a href="#" data-rel="back" data-role="button"> Cancel </a>
	</div>
    
	<!--data-position="fixed" removed. Inline styles fix the flickering issue -->
	<div id="footer-menu" data-role="footer" style="position:fixed;z-index:10;bottom:0;width:100%">
	 	<?php //echo "Loaded in: " . $this->benchmark->elapsed_time();?>
	 	<div data-role="navbar" >
	 		</style>
			<ul id="footer-nav">
				<li><a href="#picture-dialog" data-rel="popup" data-position-to="window" data-transition="pop"><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>Pictures</a></li>
				<li><a href="<?php echo site_url('member/check_in'); ?>"><?php echo img("images/icons/Location-icon.png"); ?>Check In</a></li>
				<li><a href="<?php echo site_url('member/search_media'); ?>"><?php echo img("images/icons/Music-Library-icon.png"); ?>Media</a></li>
				<li><a href="<?php echo site_url('member/add_moment'); ?>" ><?php echo img("images/icons/Comment-add-icon.png"); ?>Moment</a></li>
				<li><a href="#sleep-dialog" data-rel="popup" data-position-to="window" data-transition="pop"><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>Sleep</a></li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>
