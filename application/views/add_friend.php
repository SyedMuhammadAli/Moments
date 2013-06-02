<?php include("header.php"); ?>
<style>
#friend-lists li{
	height:60px;
	padding:6px 10px;
}
#friends-lists li a{
	height:60px;
}
#friend-lists li img{
	width:60px;
	height:60px;
}
#icon{
	width:90px; 
	height:110px;
	text-align:center;
	padding:11px;
	border-style:solid;
	border-color:#bababa;
	border-width:1px;
	float:left;
	margin-right:8px;
	border-radius:4px;
	background-color:#f9f9f9;
}
#icon:active{
	background-color:#e5e5e5;
}
#social-icons{
margin-left:20%;
margin-right:20%;
height:160px;
}
</style>
<div id="friend-lists">
	<form action="<?php echo site_url('member/search_friend'); ?>" method="post" style="width:90%; margin-left:5%;">
		<input type="text" name="friend_username" placeholder="Search Friends">
		<input type="submit" name="find_friend_btn" value="Search">
	</form>
	<ul data-role="listview" data-inset="true" style="width:90%; margin-left:5%;">
	<?php foreach($people as $p): ?>
		<li>
			<a href="<?php echo site_url('member/add_friend').'/'.$p->user_id; ?>">
				<?php echo img("images/profile_pictures/{$p->dp}"); ?>
				<span style="color:#282828"><?php echo $p->fname . " " . $p->lname; ?></span>
				<span style="margin-left:10px;font-size:12px;color:#4f4f4f;"><?php echo $p->username; ?></span>
				<p style="margin-top:10px;">Tap to Send Friend Request</p>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
	<div data-role="collapsible-set">
		<div data-role="collapsible">
			<h3>Friends</h3>
			<ul data-role="listview" data-inset="true">
			<?php foreach($friends as $f): ?>
				<li>
					<a href="#" data-ajax="false">
						<?php echo img("images/profile_pictures/{$f->dp}"); ?>
						<?php echo $f->fname . " " . $f->lname; ?>
						<span style="margin-left:10px;font-size:12px;color:#4f4f4f;"><?php echo $f->username; ?></span>
						<p style="margin-top:10px;">Tap to visit Moments</p>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
		<div data-role="collapsible" data-collapsed="false">
			<h3>Friends Request</h3>
			<ul data-role="listview" data-inset="true">
			<?php foreach($friends_request as $fr): ?>
				<li>
					<a href="<?php echo site_url('member/accept_friends_req').'/'.$fr->user_id; ?>" data-ajax="false">
						<?php echo img("images/profile_pictures/{$fr->dp}"); ?>
						<span style="color:#282828"><?php echo $fr->fname . " " . $fr->lname; ?></span>
						<span style="margin-left:10px;font-size:12px;color:#4f4f4f;"><?php echo $fr->username; ?></span>
						<p style="margin-top:10px;">Tap to accept friends request.</p>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
		<!--<div data-role="collapsible">
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
						<span style="color:#282828"><?php echo $p->fname . " " . $p->lname; ?></span>
						<span style="margin-left:10px;font-size:12px;color:#4f4f4f;"><?php echo $p->username; ?></span>
						<p>Tap to Add friend</p>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
		-->
		<!-- social media icons -->
		<div id="social-icons">
			<div id="icon" style="float:left;">
				<a href="#" style="text-decoration:none;"><?php echo img('images/icons/contacts.png');?>
				<p>Import from contacts</p>
			</div>
			<!--<p>Add friends from your contacts</p></a>-->

			<div id="icon" style="float:right;">
				<a href="#" style="text-decoration:none;"><?php echo img('images/icons/fb.png');?><!--<p>Add friends from Facebook</p></a>-->
				<p>Import from Facebook</p>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>
