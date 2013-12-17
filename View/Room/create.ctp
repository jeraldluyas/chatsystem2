<?php echo $this->Html->css('room_create', 'stylesheet', array('inline' => false)); ?>
<h2>Create new chat room</h2>
<?php
echo $this->Form->create('Room', array('type' => 'post',
    'id' => 'frmCreateRoom',
    'url' => array('controller' => 'room', 'action' => 'create'),
    'inputDefaults' => array(
         'format' => array('error', 'before', 'label', 'between', 'input', 'after'),
    ),
));
echo $this->Form->input('name',
        array('before' => '<div class="input-group">','placeholder' => 'Room\'s name here..', 'label' => false, 'class' => 'form-control', 'div' => false));
echo $this->Form->submit('create', array('before' => '<span class="input-group-btn">', 'class' => 'btn btn-primary', 'div' => false, 'after' => '</span></div>'));
echo $this->Form->end();
?>