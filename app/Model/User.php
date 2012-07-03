<?php

App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {

    public $name = 'User';
    
    public $hasMany = array( //'dependent'     => true
            'Post' => array(
                'className'     => 'Post',
                'foreignKey'    => 'user_id',
                'conditions'    => '',
                'fields'		=> 'id',
                'order'         => 'Post.created DESC',
                'limit'         => '',
                'dependent'     => true
            )
        );
    
    public $hasAndBelongsToMany = array(
      'Following' => array(
          'className' => 'User',
          'joinTable' => 'users_users',
          'foreignKey' => 'follower_id',
          'associationForeignKey' => 'following_id',
          'unique' => true,
          'conditions' => '',
          'fields' => '',
          'order' => 'Following.username ASC',
          'limit' => '',
          'offset' => '',
          'finderQuery' => '',
          'deleteQuery' => '',
          'insertQuery' => ''
        ),
      'Follower' => array(
          'className' => 'User',
          'joinTable' => 'users_users',
          'foreignKey' => 'following_id',
          'associationForeignKey' => 'follower_id',
          'unique' => true,
          'conditions' => '',
          'fields' => '',
          'order' => 'Follower.username ASC',
          'limit' => '',
          'offset' => '',
          'finderQuery' => '',
          'deleteQuery' => '',
          'insertQuery' => ''
        )
     );
     
     public function beforeSave() {
         if (isset($this->data[$this->alias]['password'])) {
             $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
         }
         return true;
     }
    
}