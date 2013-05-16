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
<div data-role="page" id="post">
  <?php include("header.php"); ?>

  <div data-role="content">
  <h4 style="text-align:center;">Thought</h4>
  <form method="post" action="<?php echo site_url('member/submit_moment'); ?>" data-ajax="false">
	  <input type="text" name="moment_text" placeholder="What's on your mind?">
	  <input type="submit" value ="post">
  </form>
  <a href="#im_with" data-role="button" data-inline="true">I'm with</a>
  <a href="#" data-role="button" data-inline="true">I'm at</a>
  </div>
  <?php include("footer.php"); ?>

 </div>
 
</body>
</html>
