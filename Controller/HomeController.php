<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {

    public $uses = array('Room');

    public function index() {
        $rooms = $this->Room->getAllRooms();
        $this->set('rooms', $rooms);
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow('index');
    }

}
