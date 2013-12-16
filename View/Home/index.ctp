<div>
    <?php echo $this->Html->link('Create Room', array('controller' => 'room', 'action' => 'create'), array('class' => 'btn btn-primary')); ?>
</div>
<table id="room-list" class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Owner</th>
        </tr>
    </thead>
    <tbody>
        <!-- Chat room list -->
        <?php foreach ($rooms as $room) { ?>
            <tr>
                <td><?php echo $room['Room']['room_id']; ?></td>
                <td>
                    <?php echo $this->Html->link($room['Room']['name'], array('controller' => 'room', 'action' => 'index', $room['Room']['room_id']));
                    ?>
                </td>
                <td><?php echo $room['User']['username']; ?></td>
            </tr>
        <?php } ?>

    </tbody>
</table>