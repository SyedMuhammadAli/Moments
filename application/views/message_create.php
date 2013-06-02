<?php include("header.php"); ?>

<div data-role="content">
    <form action="<?php echo site_url('member/messages/submit'); ?>" method="POST" data-ajax="false">
        <label for="receivers">To</label>
        <input type="text" name="receiver" value="" placeholder="To: Username" />

        <label for="message_text">Message</label>
        <textarea name="message_text" style="height: 150px;" placeholder="Write a message..."></textarea>

        <input type="submit" value="Send" />
    </form>
</div>

<?php include("footer.php"); ?>
