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
                'rule' =>  array('maxLength', 255),
                'message' => 'Room name cannot be greater than 255 characters'
            ),
        ),
    );

    public function getAllRooms() {
        $condition = array();
        return $this->find('All', $condition);
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
        }
    }

}

?>
