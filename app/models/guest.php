<?php
class Guest extends AppModel {
    var $name = 'Guest';
    var $virtualFields = array('full_name' => 'CONCAT(Guest.first_name, " ", Guest.last_name)');
    var $validate = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please supply the first name.',
            'required'=>false,
            'allowEmpty'=>false
        ),
        'last_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Please supply the last name.',
            'required'=>false,
            'allowEmpty'=>false
        )
    );
    
}
?>