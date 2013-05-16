<?php include("header.php"); ?>
 
<div data-role="content"> 
	<h3 style="text-align:center;">Settings</h3>
	<h3> Automatic </h3>

	<form action="<?php echo site_url('member/settings'); ?>" method="post" data-ajax="false">
		<h4> Me </h4>
		<hr/>
		<input type="submit" value="Set Picture" /> <br />
		<input type="submit" value="Set Cover" /><br />

		<hr />
		<input type="text" placeholder="Phone Number" name="phone" value="<?php echo $phone; ?>" /><br />
		<input type="date" placeholder="Birthday" name="birthdate" value="<?php echo $birthdate; ?>" required /><br />
		<label for="Male">Male</label>
		<input type="checkbox" name="male" id="Male" class="custom" <?php echo $gender=='m'?'checked="yes"':''; ?> />
		<label for="Female">Female</label> 
		<input type="checkbox" name="female" id="Female" class="custom" <?php echo $gender=='f'?'checked="yes"':''; ?> />

		<input type="submit" name="save-btn" value="Save" />
		<br />
	</form>

	<h4>Sharing</h4>
	Facebook <a href="https://www.facebook.com/">  Connect</a><br />
	Twitter <a href="https://twitter.com/">  Connect</a><br />

</div> <!-- content end -->

<?php include("footer.php"); ?>
