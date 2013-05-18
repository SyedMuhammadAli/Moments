<?php include("header.php"); ?>

<h4 style="text-align:center">Moments</h4>
<style>
.activity {
	float: left;
	font-weight: bold;
	font-size: 18;
}

li img { padding-right: 10px; }
</style>

<ul id="moments-ul" class="post" data-role="listview" data-filter="true">
	<?php foreach($moments as $m): ?>
	<li style="margin-bottom:10px;">
		<a href="<?php echo site_url('member/view/')."/{$m->moment_id}"; ?>">
			<?php echo img("images/profile_pictures/{$m->dp}"); ?>
			<h1><?php echo $m->username; ?></h1>
			
			<?php if($m->media_id): ?>
				<img src="<?php echo $m->media->artworkUrl; ?>" style="float: left;">
				
				<?php
					switch($m->media->name){ //type name !
						case "ebook":
							echo "<p class='activity'> Is reading </p>"; break;
						case "musicTrack":
							echo "<p class='activity'> Is listening to </p>"; break;
						case "movie":
							echo "<p class='activity'> Is watching </p>"; break;
					}
					echo "<p>" . $m->media->trackName . " by " . $m->media->artistName . "</p>";
				?>
			<?php else: ?>
				<p><?php echo parse_smileys($m->msg, $smileys_path); ?></p>
			<?php endif; ?>
			<p class="ui-li-count"><?php echo "{$m->time} ago"; ?></p>
			
		</a>
	</li>
	<?php endforeach; ?>
</ul>

<?php include("footer.php"); ?>
