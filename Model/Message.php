<?php

App::uses('AppModel', 'Model');
App::import('Component', 'StringUtils');

class Message extends AppModel {

    public $primaryKey = 'message_id';

    public function insert() {
        if ($this->data['Message']['message'] && $this->data['Message']['room_id']) {
            $this->data['Message']['message'] = trim($this->data['Message']['message']);
            $this->data['Message']['room_id'] = intval($this->data['Message']['room_id']);
            return $this->save($this->data);
        }
        return false;
    }

    public function getMessages($room_id, $getIdBefore = null, $getIdAfter = null, $limit = null) {
        $room_id = intval($room_id);
        $conditions = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array('Message.user_id = User.user_id'),
                ),
                array(
                    'table' => 'rooms',
                    'alias' => 'Room',
                    'type' => 'INNER',
                    'conditions' => array('Room.room_id = Message.room_id'),
                )
            ),
            'fields' => array('Message.*', 'User.username'),
            'conditions' => array('Message.flag < ' . FLAG_MESSAGE_DELETED .
                ' AND Message.room_id = '.$room_id),
            'order' => array('Message.message_id' => 'DESC'),
        );

        if ($getIdBefore !== null)
            $getIdBefore = intval($getIdBefore);
        if ($getIdAfter !== null)
            $getIdAfter = intval($getIdAfter);
        if ($limit !== null)
            $limit = intval($limit);

        if ($getIdBefore !== null) {
            $conditions['conditions'] =
                    array_merge($conditions['conditions'], array("Message.message_id < {$getIdBefore}"));
        }
        if ($getIdAfter !== null) {
            $conditions['conditions'] =
                    array_merge($conditions['conditions'], array("Message.message_id > {$getIdAfter}"));
        }

        if ($limit !== null) {
            $conditions['limit'] = $limit;
        }
        return $this->find('all', $conditions);
    }

    public function getMessageById($message_id) {
        $message_id = intval($message_id);
        return $this->find('first', array('conditions' => "message_id = {$message_id}"));
    }

    public function getUpdatedList($last_update) {
        if (!$last_update)
            return array();
        $last_update = intval($last_update);
        $conditions = array('conditions' => 'flag > ' . FLAG_MESSAGE_CREATED .
            ' AND update_at >=' . $last_update);
        $results = $this->find('all', $conditions);
        if ($results) {
            foreach ($results as &$mess) {
                $mess['Message']['update_time_formated'] = StringUtilsComponent::formatTimeStamp($mess['Message']['update_at'], MESSAGE_TIME_FORMAT);
            }
            return $results;
        }
        return array();
    }

    public function deleteMessage() {
        $this->data['Message']['flag'] = FLAG_MESSAGE_DELETED;
        $this->data['Message']['message_id'] = intval($this->data['Message']['message_id']);
        return $this->save($this->data);
    }

    public function editMessage() {
        $this->data['Message']['flag'] = FLAG_MESSAGE_UPDATED;
        $this->data['Message']['message_id'] = trim($this->data['Message']['message_id']);
        $this->data['Message']['message'] = trim($this->data['Message']['message']);
        return $this->save($this->data);
    }

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        $current_time = time();
        $this->data['Message']['user_id'] = AuthComponent::user('user_id');
        if (isset($this->data['Message']['message_id'])) {
            // Update
            $this->data['Message']['update_at'] = $current_time;
        } else {
            // Insert
            $this->data['Message']['create_at'] = $current_time;
            $this->data['Message']['update_at'] = $current_time;
            $this->data['Message']['flag'] = FLAG_MESSAGE_CREATED;
        }
    }

}
