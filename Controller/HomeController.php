<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {

    public $uses = array('Room');

    public function index() {
        if ($this->Auth->isAuthorized()) {
        } else {
            echo 'Not logged';
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

}
