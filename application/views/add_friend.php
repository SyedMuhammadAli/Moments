<?php include("header.php"); ?>

<div data-role="collapsible-set">
    <div data-role="collapsible" data-collapsed="false">
        <h3>Friends Request</h3>
        <ul data-role="listview" data-inset="true">
		<?php foreach($friends_request as $fr): ?>
			<li>
				<a href="<?php echo site_url('member/accept_friends_req').'/'.$fr->user_id; ?>" data-ajax="false">
					<?php echo img("images/profile_pictures/{$fr->dp}"); ?>
					<span style="color:#f37231"><?php echo $fr->fname . " " . $fr->lname; ?></span>
					<span style="margin-left:10px;font-size:12px;color:#cc5012;"><?php echo $fr->username; ?></span>
					<p>Tap to accept friends request.</p>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
    </div>
    <div data-role="collapsible">
    	<h3>Friends</h3>
    	<ul data-role="listview" data-inset="true">
		<?php foreach($friends as $f): ?>
			<li>
				<a href="#" data-ajax="false">
					<?php echo img("images/profile_pictures/{$f->dp}"); ?>
					<span style="color:#f37231"><?php echo $f->fname . " " . $f->lname; ?></span>
					<span style="margin-left:10px;font-size:12px;color:#cc5012;"><?php echo $f->username; ?></span>
					<p>Tap to accept friends request.</p>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
    </div>
    <div data-role="collapsible">
    	<h4 style="text-align:center"> Find Friends </h4>
		<form action="<?php echo site_url('member/search_friend'); ?>" method="post">
			<input type="text" name="friend_username" placeholder="Search Friends">
			<input type="submit" name="find_friend_btn" value="Search">
		</form>
	
		<ul data-role="listview" data-inset="true">
		<?php foreach($people as $p): ?>
			<li>
				<a href="<?php echo site_url('member/add_friend').'/'.$p->user_id; ?>">
					<?php echo img("images/profile_pictures/{$p->dp}"); ?>
					<span style="color:#f37231"><?php echo $p->fname . " " . $p->lname; ?></span>
					<span style="margin-left:10px;font-size:12px;color:#cc5012;"><?php echo $p->username; ?></span>
					<p>Tap to Add friend</p>
				</a>
			</li>
		<?php endforeach; ?>
		</ul>
    </div>
    
    <!-- social media icons -->
	<a href="#" style="text-decoration:none;color:#ed6423;"><?php echo img('images/icons/contacts.png');?>
	<p>Add friends from your contacts</p></a>
	<hr>
	<a href="#" style="text-decoration:none;color:#ed6423;"><?php echo img('images/icons/fb.png');?><p>Add friends from Facebook</p></a>
	<hr>
</div>

<?php include("footer.php"); ?>
