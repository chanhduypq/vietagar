<?php

class Admin_MenuController extends Core_Controller_Action 
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
        $mapper=new Admin_Model_MenuMapper();
        if ($this->_request->isPost()) {
            $id_array=  $this->_getParam("id");
            $text_vi_array=  $this->_getParam("text_vi");
            $text_cn_array=  $this->_getParam("text_cn");
            $text_en_array=  $this->_getParam("text_en");
            for($i=0,$n=count($id_array);$i<$n;$i++){
                $data=array(
                    'text_vi'=>$text_vi_array[$i],
                    'text_cn'=>$text_cn_array[$i],
                    'text_en'=>$text_en_array[$i]
                        );
                $mapper->save($data,"id=".$id_array[$i]);
            }
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
    }  
     
      
      
    
       
}