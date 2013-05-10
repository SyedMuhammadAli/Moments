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

<div data-role="page" id="comments">
  	<div data-role="header" data-fullscreen="true">
	    <h4> Moments </h4>
	    <a href="<?php echo site_url('member/index'); ?>" data-icon="home" data-iconpos="notext">Home</a>
		<div data-role="navbar" >
			<ul>
				<li><a href="#home-friends" >Friends</a></li>
				<li><a href="#home-notifications" >Notifications</a></li>
				<li><a href="#home-search">Search</a></li>
				<li><a href="#settings" >Settings</a></li>
			</ul>
		</div>
	  	<a href="<?php echo site_url('home/logout'); ?>">Sign out</a>
  	</div>
	<div data-role="content">
	<ul id="moment-comments-ul" class="post" data-role="listview">
		<li style="margin-bottom:10px;">
			
			<?php echo img("images/asif.jpg"); ?>
			
			<h1><?php echo $moment->username; ?></h1>
			<p><?php echo $moment->msg; ?></p>
			<p class="ui-li-count"><?php echo $moment->time; ?></p>
			
			<?php foreach($moment->comments as $c): ?>
			<div class="comment" >
				<?php echo img("images/asif.jpg"); ?>
				<h1><?php echo $c->username; ?></h1>
				<p><?php echo $c->msg; ?></p>
			</div>
			<?php endforeach; ?>
		</li>
	</ul>
	<form action="path/to/post_comment" method="post" data-ajax="false">
		<input type="text" name="comment_text" placeholder="Comment" />
		<input type="submit" value="Comment" />
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
</body>
</html>
