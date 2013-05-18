<?php include("header.php"); ?>
 
<div data-role="content"> 
	<h3 style="text-align:center;">Settings</h3>

	<form action="<?php echo site_url('member/settings'); ?>" enctype="multipart/form-data" method="post" data-ajax="false">
		<h4> Me </h4>
		<hr/>
		<label for="dp">Upload Profile Picture</label>
		<input id="dp" type="file" name="profile_picture" size="20" />
		<br />

		<hr />
		
		<fieldset data-role="controlgroup" data-type="horizontal">
			<label for="male">Male</label>
			<input id="male" type="radio" name="gender" value="m" class="custom" <?php if($gender=='m') echo 'checked="checked"'; ?> />
			
			<label for="female">Female</label> 
			<input id="female" type="radio" name="gender" value="f" class="custom" <?php if($gender=='f') echo 'checked="checked"'; ?> />
		</fieldset>
		<br />
		
		<label for="phone">Phone</label>
		<input id="phone" type="text" placeholder="Phone Number" name="phone" value="<?php echo $phone; ?>" /><br />
		<label for="dob">Birthday</label>
		<input id="dob" type="date" placeholder="Birthday" name="birthdate" value="<?php echo $birthdate; ?>" required /><br />
		
		<input type="submit" name="save-btn" value="Save" />
		<br />
	</form>

	<h4>Sharing</h4>
	Facebook <a href="https://www.facebook.com/">  Connect</a><br />
	Twitter <a href="https://twitter.com/">  Connect</a><br />

</div> <!-- content end -->

<?php include("footer.php"); ?>
