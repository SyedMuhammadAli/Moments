<?php include("header.php"); ?>

<div data-role="content">
    <h3><?php echo "Me and ".$friend_name; ?></h3>
    <ul data-role="listview" data-theme="d">
    <?php foreach ($messages as $m): ?>
        <li>
            <?php echo img("images/profile_pictures/".$m->sender_dp); ?>
            <h2><?php echo $m->sender_name; ?></h2>
            <p><?php echo $m->message_text; ?></p>
            <span class="ui-li-count"><?php echo $m->time; ?></span>
        </li>
    <?php endforeach; ?>
    </ul>
    <br />
    <form action="<?php echo site_url('member/messages/submit'); ?>" method="POST" data-ajax="false">
        <input type="hidden" name="receiver" value="<?php echo $friend_name; ?>"/>
        <textarea name="message_text" style="height: 150px;" placeholder="Write a message..."></textarea>
        <input type="hidden" name="thread_code" value="<?php echo $friend_id; ?>" >
        <input type="submit" value="Send" />
    </form>
</div>

<?php include("footer.php"); ?>
