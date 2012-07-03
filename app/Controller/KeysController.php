<?php

class KeysController extends AppController {

public $helpers = array('Paginator', 'Cache', 'Js');
public $components = array('RequestHandler');
public $name = 'Keys';
    
    public function index() {
        $this->Key->recursive = 0;
        $this->set('keys', $this->paginate());
    }
    
    function addKey() {
    	$length = 25;
        $random= "";
	    srand((double)microtime()*1000000);
	    $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $char_list .= "abcdefghijklmnopqrstuvwxyz";
	    $char_list .= "1234567890";
	    // Add the special characters to $char_list if needed
	    
	    for($i = 0; $i < $length; $i++)  
	    {    
	       $random .= substr($char_list,(rand()%(strlen($char_list))), 1);  
	    }  
	    debug($random);
    }
        
}