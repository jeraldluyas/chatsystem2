<?php

App::uses('AppModel', 'Model');

class Room extends AppModel {

    public $primaryKey = 'room_id';
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Room name cannot be empty'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'Room name cannot be greater than 255 characters'
            ),
        ),
    );

    public function getAllRooms($filters = array()) {
        $conditions = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Room.user_id',
                    )
                ),
            ),
            'fields' => array('Room.*', 'User.username'),
            'order' => array('Room.room_id' => 'DESC'),
        );

        foreach ($filters as $key => $value) {
            $conditions[$key] = $value;
        }

        return $this->find('all', $conditions);
    }

    public function getRoomById($room_id) {
        $room_id = intval($room_id);
        $conditions = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Room.user_id',
                    )
                ),
            ),
            'fields' => array('Room.*', 'User.username'),
            'conditions' => "Room.room_id = $room_id",
        );

        return $this->find('first', $conditions);
    }

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        $current_time = time();
        if (isset($this->data['Room']['room_id'])) {
            // Update
            $this->data['Room']['update_at'] = $current_time;
        } else {
            // Insert
            $this->data['Room']['create_at'] = $current_time;
            $this->data['Room']['update_at'] = $current_time;
            $this->data['Room']['user_id'] = AuthComponent::user('user_id');
        }
    }

}

?>
