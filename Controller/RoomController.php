<?php

App::uses('AppController', 'Controller');

class RoomController extends AppController {

    public $uses = array('Room', 'Message');

    public function index($room_id) {
        $room = $this->Room->getRoomById($room_id);
        $this->set('room', $room);
        if (!empty($room)) {
            $last_update = time();
            $idafter = 0;

            $messages = $this->Message->getMessages($room_id);
            if (!empty($messages)) {
                $messages = array_reverse($messages);
                $idafter = $messages[count($messages) - 1]['Message']['message_id'];
            }
            // Render message list
            $view = new View($this, false);
            $view->layout = false;
            $view->set(compact('messages', $messages));
            $view->viewPath = 'Message';
            $message_list = $view->render('message_list');
            $this->set('message_list', $message_list);
            $this->set('idafter', $idafter);
            $this->set('last_update', $last_update);
            $this->set('title', $room['Room']['name']);
        } else {
            $this->set('title', 'Room not found!');
        }
    }

    public function create() {
        if ($this->request->is('post')) {
            if ($this->Room->save($this->data)) {
                $this->Session->setFlash('Add new room succssfully!');
                $this->redirect(array('controller' => 'home', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Add new room failed!!!', 'flash/error');
            }
        }
    }

}

?>
