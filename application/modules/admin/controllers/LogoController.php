<?php

class Admin_LogoController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    public function indexAction() {
        $item = new Admin_Model_LogoMapper();
        $this->view->item = $item->getInfo();
        $message = Core::message()->getAll();
        if (is_array($message) && count($message) > 0) {
            $message = $message['message'];
            $this->view->message = $message[0];
        } else {
            $this->view->message = '';
        }
    }

    public function saveAction() {

        $item = new Admin_Model_LogoMapper();
        $item_image = $_FILES['logo']['name'];
        if (isset($item_image) && $item_image != "") {
            Zend_Loader::loadFile('./../library/Core/Common/File.php', null, true);
            $extension = @explode(".", $item_image);
            $extension = $extension[count($extension) - 1];
            $item_image = sprintf('_%s.' . $extension, uniqid(md5(time()), true));
            $path = UPLOAD . "/public/images/database/logo/" . $item_image;
            $item_image = "/images/database/logo/" . $item_image;
            move_uploaded_file($_FILES['logo']['tmp_name'], $path);
        }


        $result = $item->save($item_image,$this->_getParam("dynamic"));
        if ($result['file_name'] != $item_image && trim($_FILES['logo']['name']) != "") {
            $path = UPLOAD . "/public" . $result['file_name'];
            unlink($path);
        }
        if ($result['success'] == TRUE)
            Core::message()->addSuccess('Lưu thành công');
        else
            Core::message()->addSuccess('Bị lỗi. Gọi điện cho Tuệ');
        $this->_helper->redirector('index', 'logo', 'admin');
    }

}
