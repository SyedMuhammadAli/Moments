	<!--data-position="fixed" removed. Inline styles fix the flickering issue -->
	<div id="footer-menu" data-role="footer" style="position:fixed;z-index:10;bottom:0;width:100%">
	 	<div data-role="navbar" >
	 		</style>
			<ul id="footer-nav">
				<li><a href="#"><?php echo img("images/icons/Pictures-Canon-icon.png"); ?>Pictures</a></li>
				<li><a href="<?php echo site_url('member/check_in'); ?>"><?php echo img("images/icons/Location-icon.png"); ?>Check In</a></li>
				<li><a href="<?php echo site_url('member/search_media'); ?>"><?php echo img("images/icons/Music-Library-icon.png"); ?>Media</a></li>
				<li><a href="<?php echo site_url('member/add_moment'); ?>" ><?php echo img("images/icons/Comment-add-icon.png"); ?>Moment</a></li>
				<li><a href="<?php echo site_url('member/go_to_sleep'); ?>"><?php echo img("images/icons/Tent-Sleep-icon.png"); ?>Sleep</a></li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>
