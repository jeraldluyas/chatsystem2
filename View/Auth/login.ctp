<h2>Login</h2>
<?php
    echo $this->Form->create('User',
            array('type' => 'post', '
                 id'=>'frmLogin',
                'url' => array('controller' => 'auth', 'action' => 'login'))
            );
    echo $this->Form->input('username');
    echo $this->Form->input('password', array('type' => 'password'));
    echo $this->Form->end('Login');
?>