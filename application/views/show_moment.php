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

<div data-role="page" id="comments">
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
</div>
</body>
</html>
