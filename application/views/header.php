<!DOCTYPE html> 
<html> 
<head> 
	<title><?php echo $title; ?></title>

	<?php echo link_tag("js/jquery.mobile-1.3.1.min.css"); ?>
	<?php echo link_tag("css/style.css"); ?>
	<?php echo script_tag("js/jquery-1.9.1.min.js"); ?>
	<?php echo script_tag("js/jquery.mobile-1.3.1.min.js"); ?>
</head> 
<body>

<div data-role="page">
	<div data-role="header" data-fullscreen="true">
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
