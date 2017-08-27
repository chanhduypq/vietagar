<?php

class Admin_ActionController extends Core_Controller_Action 
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
        $this->_helper->viewRenderer->setNoRender();
    }  
     
      
      
    
       
}