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
		<form action="<?php echo site_url('member/search_friend'); ?>" method="post">
			<input type="text" name="friend_username" placeholder="Search Friends">
			<input type="submit" name="find_friend_btn" value="Search">
		</form>
		
		<ul>
		<?php foreach($friends as $f): ?>
			<!-- user_id, username, fname, lname, gender, dp (dp holds path to the display picture) -->
			<li><a href="<?php echo site_url('member/add_friend')."/{$f->user_id}"; ?>"><?php echo $f->username; ?></a></li>
		<?php endforeach; ?>
		</ul>
		
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
