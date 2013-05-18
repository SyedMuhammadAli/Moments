<?php include("header.php"); ?>

<div data-role="content"> 
	<h4 style="text-align:center"> Friends </h4>
	<form action="<?php echo site_url('member/search_friend'); ?>" method="post">
	<input type="text" name="friend_username" placeholder="Search Friends">
	<input type="submit" name="find_friend_btn" value="Search">
	</form>
	
	<ul data-role="listview" data-inset="true">
	<?php foreach($friends as $f): ?>
		<li>
			<a href="<?php echo site_url('member/add_friend')."/{$f->user_id}"; ?>">
				<?php echo img("images/profile_pictures/{$f->dp}"); ?>
				<span style="color:#f37231"><?php echo $f->fname . " " . $f->lname; ?></span>
				<span style="margin-left:10px;font-size:12px;color:#cc5012;"><?php echo $f->username; ?></span>
				<p>Tap to Add friend</p>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
	
	<a href="#" style="text-decoration:none;color:#ed6423;"><?php echo img('images/icons/contacts.png');?>
	<p>Add friends from your contacts</p></a>
	<hr>
	<a href="#" style="text-decoration:none;color:#ed6423;"><?php echo img('images/icons/fb.png');?><p>Add friends from Facebook</p></a>
	<hr>
</div>

<?php include("footer.php"); ?>
