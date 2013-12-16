<h2>Login</h2>
<?php
echo $this->Form->create('User', array('type' => 'post',
    'id' => 'frmLogin',
    'url' => array('controller' => 'auth', 'action' => 'login'),
    'class' => 'form-horizontal')
);
echo $this->Form->input('username', array('div' => 'control-group', 'label' => array('class' => 'control-label')));
echo $this->Form->input('password', array('div' => 'control-group', 'label' => array('class' => 'control-label')));
echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'btn btn-primary'));
echo $this->Form->end();
?>