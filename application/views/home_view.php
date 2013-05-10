<!DOCTYPE html> 
<html> 
<head> 
	<title><?php echo $title; ?></title>

	<?php echo link_tag("js/jquery.mobile-1.3.1.min.css"); ?>
	<?php echo link_tag("css/style.css"); ?>
	<?php echo script_tag("js/jquery-1.9.1.min.js"); ?>
	<?php echo script_tag("js/jquery.mobile-1.3.1.min.js"); ?>

	<?php echo script_tag("js/media.js"); ?>
</head> 
<body>
	<div data-role="page" id="home">
		<div data-role="header" data-position="fixed" data-fullscreen="true">
			<h4> Moments </h4><a href="#home" data-icon="home" data-iconpos="notext">Home</a>
			<div data-role="navbar" ><ul><li><a href="#home-friends" >Friends</a></li><li><a href="#home-notifications" >Notifications</a></li><li><a href="#home-search">Search</a></li><li><a href="#settings" >Settings</a></li></ul></div>
			<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
		</div>
		
		<h4 style="text-align:center">Moments</h4>
		
		<ul id="moments-ul" class="post" data-role="listview" data-filter="true">
		<?php foreach($moments as $m): ?>
		<li style="margin-bottom:10px;">
			<a href="<?php echo site_url('member/view/')."/{$m->moment_id}"; ?>">
			<?php echo img("images/asif.jpg"); ?>
			<h1><?php echo $m->username; ?></h1>
			<p><?php echo $m->msg; ?></p>
			<p class="ui-li-count"><?php echo $m->time; ?></p>
			</a>
		</li>
		<?php endforeach; ?>
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
</body>
</html>
