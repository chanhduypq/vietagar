<?php

class Admin_NganhngheController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    public function indexAction() {

        $mapper = new Default_Model_Index();
        $rows = $mapper->getMatHangs();
        $this->view->items = $rows;




        $message = Core::message()->getAll();
        if (is_array($message) && count($message) > 0) {
            $message = $message['message'];
            $this->view->message = $message[0];
        } else {
            $this->view->message = '';
        }
    }

    

    public function addAction() {
        
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();
        $form = new Admin_Form_Nganhnghe();
        

        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                unset($formData['for_confirm']);
                $mapper = new Default_Model_Index();
                

                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }
                if ($mapper->insert($formData)) {

                    Core::message()->addSuccess('Thêm mới thành công');
                    $this->_helper->redirector('index', 'nganhnghe', 'admin');
                } else {
                    Core::message()->addSuccess('Lỗi. Xử lý thất bại.');
                    $message = Core::message()->getAll();
                    if (is_array($message) && count($message) > 0) {
                        $message = $message['message'];
                        $this->view->message = $message[0];
                    } else {
                        $this->view->message = '';
                    }
                    $form->populate($formData);
                }
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    

    public function editAction() {

        $id_mat_hang = $this->_getParam('id');
        
        $where = "id=$id_mat_hang";
        $mapper = new Default_Model_Index();
        $row = $mapper->fetchRow($where);
        $row = $row->toArray();
        $form = new Admin_Form_Nganhnghe();







        if ($this->_request->isPost() && isset($_POST['for_confirm'])) {

            $formData = $this->_request->getPost();
            unset($formData['for_confirm']);

            if ($form->isValid($formData)) {
                
                $row = $mapper->fetchRow('id=' . $formData['id']);

                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }
                
                
                


                $mapper->update($formData, 'id=' . $formData['id']);
                Core::message()->addSuccess('Sửa thành công');
                $this->_helper->redirector('index', 'nganhnghe', 'admin');
            } else {
                $form->populate($formData);
            }
        } else {
            $form->setDefaults($row);
        }
        $this->view->form = $form;
        $this->render('add');
    }

    public function deleteAction() {
        $item_id = $this->_request->getParam('id', null);

        Zend_Loader::loadFile('Numeric.php', "./../library/Core/Common/", true);
        if (Numeric::isInteger($item_id) == FALSE)
            return;


        $where = "id=$item_id";
        $mapper = new Default_Model_Index();
        
        $mapper->delete($where);
        
        Core::message()->addSuccess('Xóa thành công');
        $this->_helper->redirector('index', 'nganhnghe', 'admin');
    }

}
