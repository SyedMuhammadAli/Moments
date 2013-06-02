<?php include("header.php"); ?>

<style>
#moment-comments-ul li {
	margin-bottom: 30px;
}

#moment-comments-ul {
	margin-bottom: 30px;
}

#moment-comments-ul p {
	padding-left: 10px;
}

.activity {
	float: left;
	font-weight: bold;
	font-size: 14px;
}

.comment-text img { /* Override styles to fix big emoticons */
	width: 19px;
	height: 19px;
}

#comments-heading {
	font-weight: bold;
	font-family: serif;
	font-size: 14px;
	text-decoration: underline;
}
</style>

<div data-role="content">
	<ul id="moment-comments-ul" class="post" data-role="listview">
		<li>
			<?php echo img("images/profile_pictures/{$moment->dp}"); ?>
			<h1><?php echo $moment->username; ?></h1>
			
			<?php if($moment->media_id): ?>
				<img src="<?php echo $moment->media->artworkUrl; ?>" style="float: left;">
				
				<?php
					switch($moment->media->name){ //type name !
						case "ebook":
							echo "<p class='activity'> Is reading </p>"; break;
						case "musicTrack":
							echo "<p class='activity'> Is listening to </p>"; break;
						case "movie":
							echo "<p class='activity'> Is watching </p>"; break;
					}
					echo "<p>" . $moment->media->trackName . " by " . $moment->media->artistName . "</p>";
				?>
			<?php else: ?>
				<p><?php echo parse_smileys($moment->msg, $smileys_path); ?></p>
			<?php endif; ?>
			<p class="ui-li-count"><?php echo "{$moment->time} ago"; ?></p>
			<br /> <br /> <!-- fix for comemnts meging with the moment -->
			
			<?php foreach($moment->comments as $c): ?>
			<div class="comment" >
				<?php echo img("images/profile_pictures/{$c->dp}"); ?>
				<h1><?php echo $c->username; ?></h1>
				<p class="comment-text"><?php echo parse_smileys($c->msg, $smileys_path); ?></p>
			</div>
			<?php endforeach; ?>
		</li>
	</ul>
	
	<form action="<?php echo site_url('member/submit_comment'); ?>" method="post" data-ajax="false">
		<input type="text" name="comment_text" placeholder="Comment" />
		<input type="hidden" name="mid" value="<?php echo $moment->moment_id; ?>" />
		<input type="submit" value="Comment" />
	</form>
</div>

<?php include("footer.php"); ?>
