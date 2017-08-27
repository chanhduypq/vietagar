<?php

class Admin_HinhnenController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    public function indexAction() {

        $form = new Admin_Form_Hinhnen();
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid(&$formData)) {
                $item = new Admin_Model_HinhnenMapper();
                $result = $item->save($formData);
                if ($result['success'] == FALSE) {
                    $this->view->error = '1';
                } else {
                    if ($result['file_name'] != $item_image) {
                        $path = UPLOAD . "/public" . $result['file_name'];
                        unlink($path);
                    }
                    $this->view->error = '0';
                }
            } else {
                $form->populate($formData);
            }
        }
        $this->view->form = $form;
    }

}
