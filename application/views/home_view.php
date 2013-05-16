<?php include("header.php"); ?>

<h4 style="text-align:center">Moments</h4>

<ul id="moments-ul" class="post" data-role="listview" data-filter="true">
	<?php foreach($moments as $m): ?>
	<li style="margin-bottom:10px;">
		<a href="<?php echo site_url('member/view/')."/{$m->moment_id}"; ?>">
			<?php echo img("images/profile_pictures/{$m->dp}"); ?>
			<h1><?php echo $m->username; ?></h1>
			<p><?php echo parse_smileys($m->msg, $smileys_path); ?></p>
			<p class="ui-li-count"><?php echo "{$m->time} ago"; ?></p>
		</a>
	</li>
	<?php endforeach; ?>
</ul>

<?php include("footer.php"); ?>
