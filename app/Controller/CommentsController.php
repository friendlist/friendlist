<?php
class CommentsController extends AppController {
	public $name = 'Comments';
    public $helpers = array('Html', 'Form', 'Paginator', 'Text');
    
    public function add() {
        if ($this->request->is('post')) {
        	$this->request->data['Comment']['user_id'] = $this->Auth->user('id'); //stores user id
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Your comment has been saved.');
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Unable to add your comment.');
            }
        }
    }

      
}