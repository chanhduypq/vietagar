<?php

class IndexController extends Core_Controller_Action {

    public function init() {
        parent::init();
    }
    

    public function indexAction() {
        
    }
    public function  loginAction()
    {       
            
        $data = $this->_request->getPost();
        if (count($data)>0) {        
            $username=$this->_request->getParam('username',null);
            $password=$this->_request->getParam('password',null);   
            $index=new Admin_Model_IndexMapper();                      
            if($index->login($username, $password)){            	
                $this->_helper->redirector('index','thi','default');                        
            }               
            else{
                $this->view->loginResult='0';                              
            }                              
        } 
            
    }
    public function  logoutAction()
    {        
        $auth = Zend_Auth::getInstance(); 
		$auth->clearIdentity();		
		$this->_helper->redirector('index','index','default');          
    }
    
    

    

}
