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

<div data-role="page" id="home-friends-addfriends">
	<?php include("header.php"); ?>
	
  	<div data-role="content"> 
  		<h4 style="text-align:center"> Friends </h4>
		<form id="form1" method="post">
		<input type="text" name="search" placeholder="Search Friends">
		<input type="submit" value="Search">
		</form>

		<a href="#" >logo1 Contacts<br>
		Add friends from your contacts</a>
		<hr>
		<a href="#">logo2 Facebook<br>
		Add friends from Facebook</a>
		<hr>
	</div>
	
  	<?php include("footer.php"); ?>
  	
  </div>
</div>

</body>
</html>
