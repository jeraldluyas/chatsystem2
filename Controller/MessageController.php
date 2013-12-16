<?php

App::uses('AppController', 'Controller');

class MessageController extends AppController {

    public $uses = array('Message');

    public function insert() {
        $this->autoRender = false;
        $response = array('status' => 'success', 'data' => '', 'error' => '');
        if ($this->request->data('message') !== null && $this->request->data('room_id') !== null) {
            $this->Message->set('message', trim($this->request->data('message')));
            $this->Message->set('room_id', intval($this->request->data('room_id')));
        }
        if (!$this->Message->insert()) {
            $response['status'] = 'error';
            $response['error'] = 'Error posting message';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function delete() {
        $this->autoRender = false;
        $response = array('status' => 'success', 'data' => '', 'error' => '');
        $message_id = intval($this->request->data('message_id'));
        $message = $this->Message->getMessageById($message_id);
        if ($message && $message['Message']['user_id'] == $this->Auth->user('user_id')) {
            $this->Message->set('message_id', $message_id);
            if (!$this->Message->deleteMessage()) {
                $response['status'] = 'error';
                $response['error'] = 'Error delete message';
            }
        } else {
            $response['status'] = 'error';
            $response['error'] = 'Its not your message!';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function edit() {
        $this->autoRender = false;
        $response = array('status' => 'success', 'data' => '', 'error' => '');
        $message_id = intval($this->request->data('message_id'));
        $message = $this->Message->getMessageById($message_id);
        if ($message && $message['Message']['user_id'] == $this->Auth->user('user_id')) {
            $new_message = trim($this->request->data('message'));
            if (!$new_message) {
                $response['status'] = 'error';
                $response['error'] = 'Message cannot be empty, if you want to remove this message please use delete instead!';
            } else {
                $this->Message->set('message_id', $message_id);
                $this->Message->set('message', $new_message);
                if (!$this->Message->editMessage()) {
                    $response['status'] = 'error';
                    $response['error'] = 'Error edit message';
                }
            }
        } else {
            $response['status'] = 'error';
            $response['error'] = 'Its not your message!';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getMessage() {
        $room_id = $this->request->data('room_id');
        $idafter = $this->request->data('idafter');

        $this->autoRender = false;
        $response = array('status' => 'success', 'data' => '', 'error' => '');

        $room_id = intval($room_id);
        $idafter = intval($idafter);
        $last_update = time();

        $messages = $this->Message->getMessages($room_id, null, $idafter);
        // Render message list
        $view = new View($this, false);
        $view->layout = false;
        $view->set(compact('messages', $messages));
        $view->viewPath = 'Message';
        $message_list_html = $view->render('message_list');

        // Set response data
        $response['data']['message_list'] = $message_list_html;
        $response['data']['new_message_count'] = count($messages);
        $response['data']['idafter'] = $idafter;
        $response['data']['last_update'] = time();
        if (!empty($messages)) {
            $response['data']['idafter'] = $messages[count($messages) - 1]['Message']['message_id'];
        }
        // Update list
        $last_update = $this->request->data('last_update');
        $messages = $this->Message->getUpdatedList($last_update);
        $response['data']['update_list'] = $messages;

        header('Content-Type: application/json');
        echo json_encode($response);
    }

}

?>
