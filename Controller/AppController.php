<?php

App::uses('Controller', 'Controller');
App::uses('Security', 'Utility');
Security::setHash('md5');

class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'home', 'action' => 'index'),
            'loginOut' => array('controller' => 'home', 'action' => 'index'),
            'authError' => 'You can\'t access this page!',
            'authorize' => array('Controller'),
            'loginAction' => array(
                'controller' => 'auth',
                'action' => 'login',
                'plugin' => null,
            ),
        ),
    );

    public function isAuthorized() {
        return true;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('auth', $this->Auth);
        // Non logged in can access thesse action
        // $this->Auth->allow('index', 'view');
    }

}
