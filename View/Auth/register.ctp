<h2>Register</h2>
<?php
echo $this->Form->create('User', array('type' => 'post', '
                 id' => 'frmRegister',
    'url' => array('controller' => 'auth', 'action' => 'register'),
    'inputDefaults' => array(
        'class' => 'form-control',
        'format' => array('before', 'between', 'label', 'input', 'error', 'after'),
        'div' => array('class' => 'form-group'),
    ))
);
echo $this->Form->input('username', array('required' => 'required'));
echo $this->Form->input('password', array('type' => 'password', 'required' => 'required'));
echo $this->Form->input('password_confirm', array('type' => 'password', 'required' => 'required', 'label' => 'Confirm-password'));
echo $this->Form->submit('Register', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>