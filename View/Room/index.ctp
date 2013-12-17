<?php echo $this->Html->css('/lib/fancybox/jquery.fancybox-1.3.4', 'stylesheet', array('inline' => false)); ?>
<?php echo $this->Html->css('room', 'stylesheet', array('inline' => false)); ?>
<?php echo $this->Html->script('/lib/fancybox/jquery.fancybox-1.3.4'); ?>
<?php echo $this->Html->script('room_index'); ?>
<?php if (!empty($room)) { ?>
    <h2><?php echo $room['Room']['name'], ' - Owner: ', $room['User']['username'] ?></h2>
    <div id="chatbox">
        <div id="screen">
            <?php echo $message_list; ?>
        </div>
        <div id="input">
            <form id="frmPost" onsubmit="return false;">
                <div class="input-group">
                    <input  type="text" id="message" name="message" value="" class="form-control"><!--
                    --><span class="input-group-btn">
                        <button class="btn btn-default" type="submit" id="btn_send" >Send</button>
                    </span>
                </div>
            </form>
        </div>
        <div id="frmEditMessageWraper" style="width: 500px;">
            <from id="frmEditMessage" onsubmit="return false;">
            <div class="form-group">
                <label>Edit message:</label>
                <textarea class="form-control" id="new_message"></textarea>
                <input type="hidden" id="edit_message_id" value="">
            </div>
            <div class="form-group" style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="save();">Save</button>
                <button type="button" class="btn btn-primary" onclick="close_edit_form()">Cancel</button>
            </div></form>
        </div>
    </div>
    <form id="frmRefresh" method="post" onsubmit="return false;" style="display: none;">
        <input type="hidden" id="idafter" value="<?php echo $idafter; ?>">
        <input type="hidden" id="last_update" value="<?php echo $last_update; ?>">
        <input type="hidden" id="room_id" value="<?php echo $room['Room']['room_id']; ?>">
    </form>
<?php } else { ?>
    <h2>Room not found!</h2>
<?php } ?>