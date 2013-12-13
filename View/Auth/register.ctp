<h2>Register</h2>
<?php
    echo $this->Form->create('User',
            array('type' => 'post', '
                 id'=>'frmRegister',
                'url' => array('controller' => 'auth', 'action' => 'register'))
            );
    echo $this->Form->input('username', array('required' => 'required'));
    echo $this->Form->input('password', array('type' => 'password', 'required' => 'required'));
    echo $this->Form->input('password_confirm', array('type' => 'password', 'required' => 'required', 'label' => 'Confirm-password'));
    echo $this->Form->end('Register');
?>