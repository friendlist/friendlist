<?php
class PostsController extends AppController {
	public $name = 'Posts';
    public $helpers = array('Html', 'Form', 'Paginator', 'Js');
    public $components = array('Session','RequestHandler');
    
    public function index() {
	    $this->Post->recursive = 0;
	    $this->set('posts', $this->Post->find('all', array('limit' => '11', 'order' => array('Post.created' => 'desc'))));
    }
    
    public function view($id) {
        $this->Post->id = $id;
        $this->Post->recursive = 2;
        $this->set('post', $this->Post->read());
    }
    
    public function add() {
        if ($this->request->is('post')) {
        	$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //stores user id

        	if (!empty($this->request->data['Post']['imgur'])) {
    			    $pic = $this->request->data['Post']['imgur'];
    			    $tmp_name = $pic['tmp_name'];
    			    
    			    if (!empty($tmp_name)) {
    			    	$data = file_get_contents($tmp_name);
    			    	
    			    	// $data is file data
    			    	    $pvars   = array('image' => base64_encode($data), 'key' => 'a2b334c7cb5353ae110aea1d7d51b91e');
    			    	    $timeout = 30;
    			    	    $curl    = curl_init();
    			    	
    			    	    curl_setopt($curl, CURLOPT_URL, 'http://api.imgur.com/2/upload.xml');
    			    	    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    			    	    curl_setopt($curl, CURLOPT_POST, 1);
    			    	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    			    	    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
    			    	
    			    	    $xml = curl_exec($curl);
    			    	
    			    	    curl_close ($curl);
    			    	    
    			    	    $object = simplexml_load_string($xml);
    			    	    
    			    	    if (!empty($object->message)) {
    			    	    	$this->Session->setFlash('Imgur : image format not supported, or image is corrupt.');
    			    	    	$this->redirect($this->referer());
    			    	    } else {
    			    	    	$this->request->data['Post']['pic_url'] = $object->links->large_thumbnail;
    			    	    	$this->request->data['Post']['pic_delete'] = $object->links->delete_page;
    			    	    }
    			    	    
    			    } 
    			        			   
        		}

            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('controller' => 'users', 'action' => 'timeline', $this->Auth->user('username')));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The status with id #' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'archives'));
        }
    }
    
    public function search($keyword) {
        if (!empty($keyword)) {
        	$condition = "Post.game_name LIKE '%$keyword%'";
        	$results = $this->Post->find('all',array('conditions' => $condition, 'limit' => '25'));
        	$this->set('results', $results);
        	$this->set('keyword', $keyword);
        } else {
        	echo("Please enter at leat one character.");
        } 
    }
      
}