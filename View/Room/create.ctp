<h2>Create new chat room</h2>
<?php
    echo $this->Form->create('Room',
            array('type' => 'post', '
                 id'=>'frmCreateRoom',
                'url' => array('controller' => 'room', 'action' => 'create'))
            );
    echo $this->Form->input('name');
    echo $this->Form->end('create');
?>