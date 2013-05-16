<?php include("header.php"); ?>

<div data-role="content">
	<ul id="moment-comments-ul" class="post" data-role="listview">
		<li style="margin-bottom:10px;">
			<?php echo img("images/profile_pictures/{$moment->dp}"); ?>

			<h1><?php echo $moment->username; ?></h1>
			<p><?php echo parse_smileys($moment->msg, $smileys_path); ?></p>
			<p class="ui-li-count"><?php echo $moment->time; ?></p>

			<?php foreach($moment->comments as $c): ?>
			<div class="comment" >
				<?php echo img("images/profile_pictures/{$c->dp}"); ?>
				<h1><?php echo $c->username; ?></h1>
				<p><?php echo parse_smileys($c->msg, $smileys_path); ?></p>
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
