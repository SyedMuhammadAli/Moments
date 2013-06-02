<!DOCTYPE html> 
<html> 
	<head> 
	<title>Moments</title>

	<?php echo link_tag("js/jquery.mobile-1.3.1.min.css"); ?>
	<?php echo link_tag("css/{$this->session->userdata('theme')}.css"); ?>
	<?php echo script_tag("js/jquery-1.9.1.min.js"); ?>
	<?php echo script_tag("js/jquery.mobile-1.3.1.min.js"); ?>
	
</head> 
<body> 
<!-------------------Sign In page starts -------------------->
<div data-role="page" id="signin" data-title="Moments: Signin" >

	<div data-role="header" >
		<h4 style="padding:0px; margin:0 auto;"><?php echo img('images/icons/logo.png');?></h4>
	</div><!-- /header -->
	
	<div data-role="content">
		<form action="<?php echo site_url('home/login'); ?>" method="post" data-ajax="false">
 
			<fieldset data-role="fieldcontain"> 
				<label for="username">Username:</label>
				<input type="text" name="username" id="username">
			</fieldset>
 
			<fieldset data-role="fieldcontain"> 
				<label for="password">Password:</label>
				<input type="password" name="password" id="password">
			</fieldset>
			<input type="submit" value="Sign In!">
		</form>
		<hr />
		<a href="#forgot" data-role="button">Forgot Password?</a>
		<a href="#register" data-role="button">Signup</a>
		<p style="text-align: center;">By signin in, I accept Moment's <strong>Terms of Service</strong> and <strong>Privacy Policy</strong>.</p>
	</div><!-- /content -->

</div><!-- /page -->

<!-------------------Sign In page ends ------------------->

<!-------------------Register page starts ---------------->

<div data-role="page" id="register" data-title="Moments: Signup">

	<div data-role="header">
		<a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Back</a>
		<h1>Moments</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<form action="<?php echo site_url('home/register'); ?>" method="post" data-ajax="false">
 			<fieldset data-role="fieldcontain"> 
				<label for="fname">FirstName:</label>
				<input type="text" name="fname" id="fname">
			</fieldset>
			<fieldset data-role="fieldcontain"> 
				<label for="lname">Last Name:</label>
				<input type="text" name="lname" id="lname">
			</fieldset>
			<fieldset data-role="fieldcontain"> 
				<label for="username">Username:</label>
				<input type="text" name="username" id="username">
			</fieldset>
 			<fieldset data-role="fieldcontain"> 
				<label for="email">Email:</label>
				<input type="email" name="email" id="email">
			</fieldset>
			<fieldset data-role="fieldcontain"> 
				<label for="password">Password:</label>
				<input type="password" name="password" id="password">
			</fieldset>
			<fieldset data-role="fieldcontain"> 
				<label for="password">Confirm Password:</label>
				<input type="password" name="password2" id="password2">
			</fieldset>

			<input type="submit" value="Sign Up!">
		</form>		
	</div><!-- /content -->

</div><!-- /page -->
<!---------------------Register page ends ---------------->

<!----------------forgot password starts ---------------------------------->
<div data-role="page" id="forgot" data-title="Moments: Forgot Password">

	<div data-role="header">
		<a href="#" data-rel="back" data-icon="back" data-iconpos="notext">Back</a><h1>Moments</h1>
	</div><!-- /header -->

	<div data-role="content">
		<form action="<?php echo site_url('home/forgot_password'); ?>" method="post" data-ajax="false">
 
			<fieldset data-role="fieldcontain"> 
				<label for="email">Enter your Email Address:</label>
				<input type="email" name="email" id="email">
			</fieldset>
			<input type="submit" value="Send">
		</form>
	</div>
	
</div>
<!----------------forgot password ends --------------------------------->

</body></html>
