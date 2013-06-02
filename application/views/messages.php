<?php include("header.php"); //die( json_encode($message_list) ); ?>

<div data-role="content">
    <ul data-theme="d" data-role="listview" data-filter="true" data-filter-placeholder="Search..." data-inset="true">
    <?php foreach ($message_list as $mi): ?>
        <li>
            <a href="<?php echo site_url('member/messages/view/')."/".$mi["user_id"]; ?>" data-ajax="false">
            <?php echo img("images/profile_pictures/".$mi["dp"]); ?>
            <h2><?php echo $mi["username"]; ?></h2>
            <p><?php echo end( $mi["conversations"] )->message_text; ?></p></a>
        </li>
    <?php endforeach; ?>
    </ul>

    <a href="<?php echo site_url('member/messages/create'); ?>" 
    data-role="button" 
    data-inline="true" 
    data-icon="plus" 
    data-theme="a" 
    data-mini="true"
    data-ajax="false">
        New Message
    </a>
</div>

<?php include("footer.php"); ?>
