<?php

class Admin_HeaderController extends Core_Controller_Action 
{
    public function init()
    {  
        parent::init();
        $auth = Zend_Auth::getInstance();
        if(!$auth->hasIdentity())
        {
        	$this->_helper->redirector('index','index','admin');
        }
    }
    
    public function indexAction(){ 
        $mapper=new Admin_Model_HeaderMapper();
        if ($this->_request->isPost()) {
            $data=$this->_request->getPost();
            $mapper->save($data);
            Core::message()->addSuccess('Lưu thành công');            
        } 
        $message = Core::message()->getAll();
        if (is_array($message) && count($message) > 0) {
            $message = $message['message'];
            $this->view->message = $message[0];
        } else {
            $this->view->message = '';
        }
        $this->view->data=$mapper->getData();
        $dynamic=$mapper->getDynamic();
        $this->view->dynamic=$dynamic;
        
    }  
     
      
      
    
       
}