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

<div data-role="page" id="plus_moon">
	<?php include("header.php"); ?>
	
  <div data-role="content"> 
  	<h3>Would you like to go to sleep?</h3>
	<ul data-role="listview">
    <li> <a href="<?php echo site_url('member/go_to_sleep/sleep'); ?>">Go to Sleep</a> </li>
    <li> <a href="<?php echo site_url('member/go_to_sleep/awake'); ?>">I'm Awake</a> </li>
	</ul>
    <br>
    <p><a href="<?php echo site_url('member'); ?>" data-role="button"> Cancel </a></p> 
	</div>
	<?php include("footer.php"); ?>
</div>
</body>
</html>
