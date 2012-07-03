<?php

class Post extends AppModel {

    public $name = 'Post';
    
    public $hasMany = array(
            'Comment' => array(
                'dependent' => true
            )
        );
    
    public $belongsTo = array(
            'User' => array(
                'fields'   => array('username', 'email', 'created', 'hash'),
                'counterCache' => true
            ),
            'Platform'
        );  
     
	function get_posts($offset=0) {
		$posts = $this->find('all', array('offset' => $offset, 'limit' => 10, 'order' => array('Post.created' => 'desc')));
		return $posts;
	}
     
	function num_posts() {
		return $this->find('count');
	}
          
}