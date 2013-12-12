<?php

App::uses('AppController', 'Controller');

class HomeController extends AppController {

    public $uses = array();

    public function index() {
        try {
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
