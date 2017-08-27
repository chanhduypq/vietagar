<?php

class Admin_IndexController extends Core_Controller_Action 
{
    public function init()
    { 
        parent::init();       
    }
    
    public function  xemgiaAction()
    {
    	$this->_helper->layout()->disableLayout();    	 
    }
    public function  xemgiaajaxAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$data=$this->_request->getParams();    	
    	if($data["password"]==""||$data["confirm_password"]==""){
    		echo 'Vui lòng nhập đầy đủ các thông tin có kí hiệu *';
    		return;
    	}
    	
    	 
    	if($data["password"]=="price1"&&$data["confirm_password"]=="price2"){
    	    $auth = Zend_Auth::getInstance();
    	    if($auth->hasIdentity())
    	    {
    	    	$identity = $auth->getIdentity();    	    	
    	    	$auth->getStorage()->write($identity);    	    	
    	    }
    		echo "Thành công.";    		
    		return ;
    	}
    	else{
    	    echo "Thông tin bạn vừa nhập không chính xác.";
    	    return ;
    	}
    	echo "Lỗi đường truyền Internet. Vui lòng thử lại một lần nữa.";
    
    }
    public function  angiaajaxAction()
    {
    	$this->_helper->layout()->disableLayout();    	
    	 
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$identity = $auth->getIdentity();    		
    		$auth->getStorage()->write($identity);    	
    	}   
    }
    public function jspushAction(){
    	$this->_helper->layout()->disableLayout();
    	$adapter     = new Zend_ProgressBar_Adapter_JsPush(array('updateMethodName' => 'Zend_ProgressBar_Update',
    			'finishMethodName' => 'Zend_ProgressBar_Finish'));
    	$progressBar = new Zend_ProgressBar($adapter, 0, 100);
    	$text='';
    	for ($i = 1; $i <= 100; $i++) {    		
    		$progressBar->update($i, $text);
    		usleep(100000);
    	}    	
    	$progressBar->finish();
    }
    
    public function indexAction(){    
    	
        $auth = Zend_Auth::getInstance();		 
        if($auth->hasIdentity())
		{
		    $identity = $auth->getIdentity();
		    if($identity['user']=='admin')
		       $this->_helper->redirector('index','action','admin');		      		    		    
		}
		
		//       
        $loginResult=$this->_request->getParam('loginResult');
        if($loginResult=='0'){
            $this->view->loginResult="Thông tin bạn vừa nhập không đúng.";            
        }   
           
               
    }  
    public function loginAction(){        
        $username=$this->_request->getParam('username',null);
        $password=$this->_request->getParam('password',null);       
        if($username==null||$password==NULL){
           $this->_helper->redirector('index','index','admin'); 
        }           
        else {            
            $index=new Admin_Model_IndexMapper();                      
            if($index->login($username, $password)){            	
                $this->_helper->redirector('index','action','admin');                        
            }               
            else{                
                $this->_helper->redirector('index','index','admin',array('loginResult'=>'0'));                
            }                              
        }            
               
    }    
    public function  logoutAction()
    {        
        $auth = Zend_Auth::getInstance(); 
		$auth->clearIdentity();		
		$this->_helper->redirector('index','index','admin');          
    }
    public function  changepasswordAction()
    {
        $this->_helper->layout()->disableLayout();             		                            
    }
    public function ajaxchangepasswordAction(){
        $this->_helper->layout()->disableLayout();
        $oldPassword=$this->_request->getParam('oldPassword');        
        $auth = Zend_Auth::getInstance();        
        $identity=$auth->getIdentity();
        if($identity['password']!=$oldPassword){            
            echo 'error';          
            return ;           
        }    
        $newPassword=$this->_request->getParam('newPassword');
        $index=new Admin_Model_IndexMapper(); 
        $index->changePassword($identity['username'], $newPassword,'user');
        echo "";       
    }  
       
}