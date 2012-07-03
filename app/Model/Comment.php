<?php

class Comment extends AppModel {

    public $name = 'Comment';
    
    public $belongsTo = array(
            'Post' => array(
            	'counterCache' => true
            ),
            'User' => array(
            	'fields' => array('username', 'email')
            ));

    
}