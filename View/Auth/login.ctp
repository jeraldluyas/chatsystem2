<h2>Login</h2>
<?php
echo $this->Form->create('User', array('type' => 'post',
    'id' => 'frmLogin',
    'url' => array('controller' => 'auth', 'action' => 'login'),
    'inputDefaults' => array(
        'class' => 'form-control',
        'format' => array('before', 'between', 'label', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
    ))
);
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->submit('Login', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>