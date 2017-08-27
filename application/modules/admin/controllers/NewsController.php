<?php

class Admin_NewsController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    public function indexAction() {
        $mapper = new Admin_Model_NewsMapper();
        $item=$mapper->getNoiDung();
        $noi_dung_vi='';
        $noi_dung_cn='';
        $noi_dung_en='';
        if(is_array($item)&&count($item)>0){
            $noi_dung_vi=$item['news_vi'];
            $noi_dung_cn=$item['news_cn'];
            $noi_dung_en=$item['news_en'];
        }
        $this->view->news_vi=$noi_dung_vi;
        $this->view->news_cn=$noi_dung_cn;
        $this->view->news_en=$noi_dung_en;
        
        
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
        $item = new Admin_Model_NewsMapper();
        $result = $item->save($data);        
        if ($result == true)
            Core::message()->addSuccess('Lưu thành công');
        else
            Core::message()->addSuccess('Bị lỗi. Gọi điện cho Tuệ');

        $this->_helper->redirector('index', 'news', 'admin');
    }

}
