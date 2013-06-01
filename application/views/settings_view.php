<?php include("header.php"); ?>
 
<div data-role="content"> 
	<h3 style="text-align:center;">Settings</h3>

	<form action="<?php echo site_url('member/settings'); ?>" enctype="multipart/form-data" method="post" data-ajax="false">
		<h4> Me </h4>
		<hr/>
		<label for="dp">Upload Profile Cover</label>
		<input id="cvr" type="file" name="cover_picture" size="20" />
		<br />
		<label for="dp">Upload Profile Picture</label>
		<input id="dp" type="file" name="profile_picture" size="20" />
		<hr />
		
		<!-- theme selector -->
		<label for="theme_id">Select Theme </label>

		<?php 
		
		$options = array();

		for($i=0; $i<count($all_theme); $i++)
			$options[ $all_theme[$i]->theme_id ] = $all_theme[$i]->theme_name;
		
		echo form_dropdown('theme_id', $options, $theme_id);
			
		?>
		<!-- end theme selector -->
		
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
	<a href="https://www.facebook.com/"><?php echo img('images/icons/fb.png');?></a>
	<a href="https://twitter.com/" ><?php echo img('images/icons/twitter.png');?></a><br />

</div> <!-- content end -->

<?php include("footer.php"); ?>
