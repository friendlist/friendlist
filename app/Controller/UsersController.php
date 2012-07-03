<?php

class UsersController extends AppController {

public $helpers = array('Paginator', 'Cache', 'Js');
public $components = array('RequestHandler');
public $name = 'Users';

//    public function add() {
//        if ($this->request->is('post')) {
//        	$this->request->data['User']['hash'] = md5(strtolower(trim($this->data['User']['email'])));
//            $this->User->create();
//            if ($this->User->save($this->request->data)) {
//            	$siteroot = Router::url('/',true);
//            	$email = new CakeEmail();
//            	$email->from(array('noreply@currently.com' => 'currently'));
//            	$email->to($this->data['User']['email']);
//            	$email->subject('Your account');
//            	$email->send('Your account have been created successfully. '.$siteroot);
//                $this->Session->setFlash(__('The user has been saved'));
//                $this->redirect(array('controller' => 'users', 'action' => 'login'));
//            } else {
//                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
//            }
//        }
//    }
    
    public function register() {
    	if ($this->request->is('post')) {
    		$this->loadModel('Key');
    		$validKey = $this->Key->find('first', array(
    			'conditions' => array(
    					'Key.key' => $this->data['User']['key'],
    			),
    		));
    		
    		if ($validKey == false) {
    			$this->Session->setFlash(__('This key is incorrect'));
    		} else {
    		
	    		$this->request->data['User']['hash'] = md5(strtolower(trim($this->data['User']['email'])));
	    	    $this->User->create();
	    	    if ($this->User->save($this->request->data)) {
	    	    	$siteroot = Router::url('/',true);
	    	    	$email = new CakeEmail();
	    	    	$email->from(array('noreply@currently.com' => 'currently'));
	    	    	$email->to($this->data['User']['email']);
	    	    	$email->subject('Your account');
	    	    	$email->send('Your account have been created successfully. '.$siteroot);
	    	        $this->Session->setFlash(__('The user has been saved'));
	    	        $this->redirect(array('controller' => 'users', 'action' => 'login'));
	    	    } else {
	    	        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
	    	    }
    	    
    	    }
    	}
    }
    
    public function login() {
        if ($this->request->is('post')) { 
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }    
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function homepage() {
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all', array('limit' => '11')));
    }
    
    public function view($id) {
    	$user = $this->User->find('first', array(
    		'conditions' => array(
    			"or" => array(
    				'User.hash' => $id,
    				'User.username' => $id
    			)
    		),
    	));
    	
    	if (empty($user)) {
    		$this->Session->setFlash('The user with username &quot;'.$id.'&quot; does not exist.');
    		$this->redirect($this->referer());
    	}
    	
    	$this->set(compact('user'));
    	
    	$followers_id = Set::extract('/Follower/id', $user); //get all followers ids
    	$this->set('followers_id', $followers_id);
    	
    	$following_id = Set::extract('/Following/id', $user); //get all following ids
    	$this->set('following_id', $following_id);
    	
 		$follower_data = Set::extract('/Follower/UsersUser[follower_id=' . $this->Auth->user('id') . ']', $user); //get the association row ID
 		$row_id = Set::extract('/UsersUser/id', $follower_data);
 		$this->set('row_id', $row_id);
 		
 		$this->loadModel('Post');
		$this->paginate = array('Post' => array('conditions' => array('User.id' => $user['User']['id']), 'limit' => '10', 'order' => array('Post.created' => 'desc')));
		$data = $this->paginate('Post');
	    $this->set('posts', $data);
    	
    }
    
    public function follow($user_id) {
    $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
    $followers_id = Set::extract('/Follower/id', $user);
	    if (in_array($this->Auth->user('id'), $followers_id)) {
	    	$this->Session->setFlash(__('You are already following this user.'));
	    	$this->redirect($this->referer());
	    } else {
	    	$this->User->bindModel(array('hasOne'=>array('UsersUsers')),false);
	    		if ($this->User->UsersUsers->save($this->request->data)) {
	    	      $this->redirect($this->referer());
	    	    }
	    	    else {
	    	      $this->Session->setFlash('Unable to follow this user.');
	    	      $this->redirect($this->referer());
	    	    }
	    }
    
    }
    
    public function unfollow($row_id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->User->UsersUser->delete($row_id)) {
            $this->redirect($this->referer());
        }
    }
    
    public function getmore_profile($id) {
    	if ($this->RequestHandler->isAjax()) {
    	    $this->layout = 'ajax';
    	    $user = $this->User->find('first', array(
    	    	'conditions' => array(
    	    		"or" => array(
    	    			'User.hash' => $id,
    	    			'User.username' => $id
    	    		)
    	    	),
    	    ));
    	    $this->set(compact('user'));
    	    $following_id = Set::extract('/Following/id', $user);
    	    $this->loadModel('Post');
    	    $this->paginate = array('Post' => array('conditions' => array('User.id' => $user['User']['id']), 'limit' => '10', 'order' => array('Post.created' => 'desc')));
    	    $data = $this->paginate('Post');
    	    $this->set('posts', $data);
    	} else {
    		$this->redirect(array('controller' => 'users', 'action' => 'homepage'));
    	}
    }
    
    public function getmore_timeline($id) {
    	if ($this->RequestHandler->isAjax()) {
    	    $this->layout = 'ajax';
    	    $user = $this->User->find('first', array(
    	    	'conditions' => array(
    	    		"or" => array(
    	    			'User.hash' => $id,
    	    			'User.username' => $id
    	    		)
    	    	),
    	    ));
    	    $this->set(compact('user'));
    	    $following_id = Set::extract('/Following/id', $user);
    	    $this->loadModel('Post');
    	    $id_list = Set::insert($following_id, 'logged_user', $this->Auth->user('id'));
    	    $this->paginate = array('Post' => array('conditions' => array('User.id' => $id_list), 'limit' => '10', 'order' => array('Post.created' => 'desc')));
    	    $data = $this->paginate('Post');
    	    $this->set('posts', $data);
    	} else {
    		$this->redirect(array('controller' => 'users', 'action' => 'homepage'));
    	}
    }

    public function timeline($id) {
    	$this->set('isAjax', $this->RequestHandler->isAjax());
    	if ($this->RequestHandler->isAjax()) {
    	    $this->layout = false;
    	} else {
    		$this->layout = 'manager';
    	}
	    $user = $this->User->find('first', array(
	    	'conditions' => array(
	    		"or" => array(
	    			'User.hash' => $id,
	    			'User.username' => $id
	    		)
	    	),
	    ));
	    $this->set(compact('user'));
	    $following_id = Set::extract('/Following/id', $user);
	    $this->loadModel('Post');
	    $id_list = Set::insert($following_id, 'logged_user', $this->Auth->user('id'));
		$this->paginate = array('Post' => array('conditions' => array('User.id' => $id_list), 'limit' => '10', 'order' => array('Post.created' => 'desc')));
		$data = $this->paginate('Post');
	    $this->set('posts', $data);
    }
    
    public function search($keyword) {
	    if (!empty($keyword)) {
	    	$condition = array('OR'=>array("User.username LIKE '%$keyword%'","User.email LIKE '%$keyword%'"));
	    	$results = $this->User->find('all',array('conditions' => $condition));
	    	$this->set('results', $results);
	    } else {
	    	echo("Please enter at leat one character.");
	    } 
    }
        
}