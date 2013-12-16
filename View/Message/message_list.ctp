<?php foreach ($messages as $message) { ?>
    <div class="post" data-id="<?php echo $message['Message']['message_id']; ?>">
        <p class="author"><?php echo StringUtilsComponent::htmlentities($message['User']['username']); ?>:</p>
        <p class="message"><?php echo StringUtilsComponent::htmlentities($message['Message']['message']); ?></p>
        <p class="meta">
            <span class="mod_action">
                <?php if ($message['Message']['user_id'] == $auth->user('user_id')) { ?>
                    <span class="edit" onclick="show_edit_popup('<?php echo $message['Message']['message_id']; ?>')">[ Edit ]</span>
                    <span class="delete" onclick="delete_message('<?php echo $message['Message']['message_id']; ?>')"> [ Delete ]</span> |
                <?php } ?>
            </span>
            <span class="time"><?php if (intval($message['Message']['flag']) === 1) {
                ?>Edited at<?php } else { ?>Sent at<?php } ?>:
                <?php echo StringUtilsComponent::formatTimeStamp($message['Message']['create_at'], MESSAGE_TIME_FORMAT); ?>
            </span></p>
    </div>
<?php } ?>