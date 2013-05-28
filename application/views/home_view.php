<?php include("header.php"); ?>

<h4 style="text-align:center">Moments</h4>
<style>
.activity {
	float: left;
	font-weight: bold;
	font-size: 18;
}

li img {
	padding-right: 10px;
}

#moments-ul li {
	padding-bottom:70px;
}

audio
{
width: 200px;
float: left;
-moz-border-radius:7px 7px 7px 7px ;
-webkit-border-radius:7px 7px 7px 7px ;
border-radius:7px 7px 7px 7px ;
}
</style>
<ul id="moments-ul" class="post" data-role="listview" data-filter="true">
	<?php foreach($moments as $m): ?>
	<li>
		<!-- a href="<?php echo '#'; //site_url('member/view/')."/{$m->moment_id}"; ?>" -->
			<?php echo img( array("src" => "images/profile_pictures/{$m->dp}", "class" => "dp-img") ); ?>
			<h1><?php echo $m->username; ?></h1>
			
			<?php if($m->media_id): ?>
				<img src="<?php echo $m->media->artworkUrl; ?>" style="float: left;">
				
				<?php
					switch($m->media->name){ //type name !
						case "ebook":
							echo "<p class='activity'> Is reading </p>"; break;
						case "musicTrack":
							echo <<< HERE
							<p class='activity'> Is listening to </p> <br />
							<audio controls>
								<source src='{$m->media->previewUrl}' type='audio/mpeg' />
								Your browser does not support the audio element.
							</audio>
HERE;
							break;
						case "movie":
							echo "<p class='activity'> Is watching </p>"; break;
					}
					echo "<br /><br />";
					echo "<p class='activity'>" . $m->media->trackName . " by " . $m->media->artistName . "</p>";
				?>
			<?php endif; ?>
			<p><?php echo parse_smileys($m->msg, $smileys_path); ?></p>
			<br />
			<p><?php if(property_exists($m, "location")) echo "Location: " . $m->location->address; ?></p>
			<p class="ui-li-count"><?php echo "{$m->time} ago"; ?></p>
			
		</a>
	</li>
	<?php endforeach; ?>
</ul>

<?php include("footer.php"); ?>
