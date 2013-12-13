<?php

App::uses('AppController', 'Controller');

class AuthController extends AppController {

    public $uses = array('User');

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Your username or password is not correct!');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->data)) {
                $this->Session->setFlash("New User Created!");
                $this->redirect(array('action' => 'login'));
            }
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register');
    }

}
