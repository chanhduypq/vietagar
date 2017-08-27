<?php

class Admin_UsController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    public function indexAction() {
        $mapper = new Admin_Model_UsMapper();
        $item=$mapper->getNoiDung();
        $noi_dung_vi='';
        $noi_dung_cn='';
        $noi_dung_en='';
        if(is_array($item)&&count($item)>0){
            $noi_dung_vi=$item['us_vi'];
            $noi_dung_cn=$item['us_cn'];
            $noi_dung_en=$item['us_en'];
        }
        $this->view->us_vi=$noi_dung_vi;
        $this->view->us_cn=$noi_dung_cn;
        $this->view->us_en=$noi_dung_en;
        
        
        $message = Core::message()->getAll();
        if (is_array($message) && count($message) > 0) {
            $message = $message['message'];
            $this->view->message = $message[0];
        } else {
            $this->view->message = '';
        }
    }

    public function saveAction() {


        $data = $this->_request->getPost();
        $item = new Admin_Model_UsMapper();
        $result = $item->save($data);        
        if ($result == true)
            Core::message()->addSuccess('Lưu thành công');
        else
            Core::message()->addSuccess('Bị lỗi. Gọi điện cho Tuệ');

        $this->_helper->redirector('index', 'us', 'admin');
    }

}
