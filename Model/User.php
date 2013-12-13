<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

    public $primaryKey = 'user_id';

    public $validate = array(
        'username' => array(
            'maxLength' => array(
                'rule' => array('maxLength', 32),
                'message' => 'Username must be maximum 32 characters.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Username must be mat least 5 characters.',
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Username cannot be empty.',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Username has been taken by another user.',
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password cannot be empty',
            ),
        ),
        'password_confirm' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Confirm password cannot be empty',
            ),
            'matchPassword' => array(
                'rule' => array('matchPassword'),
                'message' => 'Confirm password not match',
            ),
        ),
    );

    public function matchPassword($data){
        if($data['password_confirm'] === $this->data['User']['password']){
            return true;
        }
        return false;
    }

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if(isset($this->data['User']['password'])){
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
    }
}
