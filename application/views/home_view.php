<?php include("header.php"); ?>

<style>
.activity {
	margin-left:10px;
	font-weight: bold;
	font-size: 12px;
	color:#616161;
}

li img {
	padding-right: 10px;
}


audio
{
width: 200px;
float: left;
-moz-border-radius:7px 7px 7px 7px ;
-webkit-border-radius:7px 7px 7px 7px ;
border-radius:7px 7px 7px 7px ;
}

#profile-pic{
	height:72px;
	width:72px;
	position:absolute;
	z-index:1000;
	margin:50px;
	padding:25px;
	background-image:url(../../images/icons/profile-pic-frame.png);
	background-repeat:no-repeat;
}
#profile-pic img{
	width:74px;
	height:74px;
}
#profile{
	height:200px;
	width:100%;
	overflow:hidden;

}
#moments-ul li{
	margin-bottom:0px;
}
#comment-box{
	background-color:#EEEEEE;
	margin-bottom:5px;
	padding-left:96px;
	padding-right:20px;
	padding-top:8px;
	padding-bottom:8px;
}
#comment-box a{
	text-decoration:none;
	color:#d9d9d9;
	padding:0.2em 4px;
	font-size:12px;
	border-color:#a1a1a1;
}
#cover{
	height:200px;
	width:100%;
	overflow:hidden;
	position:absolute;
}
#cover img{
	width:100%;
	height:100%;
}

#media-img{
	float:left;
	height:70px;
	width:70px;
}
#time{
	font-size:12px;
	float:right;
}
</style>

<?php
	$display_picture = $this->session->userdata("dp");
	$cover = $this->session->userdata("cover");
?>

<div id="profile">
	<div id="cover"><?php echo img('images/cover_pictures/'.$cover);?></div>
	<div id="profile-pic"><?php echo img('images/profile_pictures/'.$display_picture);?></div>
</div>

<ul id="moments-ul" class="post" data-role="listview" data-filter="true">
	<?php foreach($moments as $m): ?>
	<li>
		<?php echo img( array("src" => "images/profile_pictures/{$m->dp}", "class" => "dp-img") ); ?>
		<span><?php echo $m->username; ?></span>
		
		<?php if($m->media_id): ?>
			<?php
				switch($m->media->name){ //type name !
				case "ebook":
					echo "<span class='activity'> Is reading </span>".img('images/icons/book.png')."<br/><img src='{$m->media->artworkUrl}' id='media-img'>"; break;
				case "musicTrack":
					echo 
					"<span class='activity'> Is listening to </span>".img('images/icons/headphone.png')." <br />
					<img src='{$m->media->artworkUrl}' id='media-img'>
					<audio controls>
						<source src='{$m->media->previewUrl}' type='audio/mpeg' />
						Your browser does not support the audio element.
					</audio>";

					break;
				case "movie":
					echo "<span class='activity'> Is watching </span>".img('images/icons/movie.png')."<br/><img src='{$m->media->artworkUrl}' id='media-img'>"; break;
				}
				echo "<br /><br />";
				echo "<p class='activity'>" . $m->media->trackName . " by " . $m->media->artistName . "</p>";
			?>
		<?php endif; ?>
		<p><?php echo parse_smileys($m->msg, $smileys_path); ?></p>
		<br />
		<p style="margin:0px;"><?php if(property_exists($m, "location")) echo img('images/icons/location.png')  . $m->location->address; ?></p>
		 <!--<a  href="<?php echo site_url('member/view/')."/{$m->moment_id}"; ?>">Comment</a>-->
		<!--<span id="time" ><?php echo "{$m->time} ago"; ?></span>-->
	</li>
	<div id="comment-box"><a class="ui-btn-up-b" href="<?php echo site_url('member/view/')."/{$m->moment_id}"; ?>">Comment</a>
	<span id="time" ><?php echo "{$m->time} ago"; ?></span></div>
	
	<?php endforeach; ?>
</ul>

<?php include("footer.php"); ?>
