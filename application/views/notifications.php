<?php include("header.php"); ?>

<script>
//refresh every 10 sec
</script>

<div data-role="content">
	<?php if(count($notifications) == 0): ?>
		<h4>Notifications will be generated as you use Moments.</h4>
	<?php endif; ?>
	
	<ul data-role="listview">
		<?php foreach($notifications as $n): ?>
		<li>
			<a href="#">
			<!-- username, fname, lname of sender + time, is_read, type_id available -->
			<p><h3><?php echo $n->username; ?></h3> <?php echo $n->action; ?></p>
			<h6><?php echo $n->time; ?></h6>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php include("footer.php"); ?>
