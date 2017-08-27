<?php

class Admin_UserController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    public function indexAction() {

        $limit = $this->_getParam('limit', 5);






        $page = $this->_getParam('page', 1);


        $start = (($page - 1) * $limit);
        $mapper = new Default_Model_User();
        $rows = $mapper->getUsers($total, $limit, $start);
        $this->view->items = $rows;



        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Null($total));
        $paginator->setDefaultScrollingStyle();
        $paginator->setItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        $this->view->params = $this->_getAllParams();

        $this->view->paginator = $paginator;
        $this->view->start = $start;
        $this->view->filter_order = $this->_getParam('filter_order');
        $this->view->filter_order_Dir = $this->_getParam('filter_order_Dir');
        $this->view->result = $this->_request->getParam('result', array());

        $this->view->limit = $limit;
        $this->view->total = $total;




        $message = Core::message()->getAll();
        if (is_array($message) && count($message) > 0) {
            $message = $message['message'];
            $this->view->message = $message[0];
        } else {
            $this->view->message = '';
        }
    }

    private function processSpecialInput($form, &$formData) {
        try {
            foreach ($form->getElements() as $element) {
                if ($element instanceof Core_Form_Element_Date) {
                    $array = explode("/", $element->getValue());
                    if (count($array) == 3) {
                        $date = $array[2] . '-' . $array[1] . '-' . $array[0];
                        $formData[$element->getName()] = $date;
                    }
                } elseif ($element instanceof Core_Form_Element_File) {
                    if ($element->getForInsertDB() == false) {
                        if ($_FILES[$element->getName()]['name'] != "") {
                            $file_name = $element->getRandomFileName();
                            if ($element->isUploaded($file_name) && $element->isValid($file_name)) {
                                $element->receive();
                            }
                            if (isset($file_name) && $file_name != "") {
                                $file_name = $element->getPathStoreFile() . $file_name;
                            }
                            $formData[$element->getName()] = $file_name;
                        }
                    } else if ($element->getForInsertDB() == true) {
                        $file_key_array = array('type', 'size', 'name');
                        foreach ($this->getElements() as $key => $value) {
                            if (in_array($key, $file_key_array)) {
                                $formData[$key] = $_FILES[$element->getName()][$key];
                            }
                        }
                        $file = fopen($_FILES[$element->getName()]['tmp_name'], "r", 1);
                        if ($file) {
                            $fileContent = base64_encode(file_get_contents($_FILES[$element->getName()]['tmp_name']));
                        } else {
                            $fileContent = null;
                        }
                        $formData[$element->getName()] = $fileContent;
                    }
                }
            }
        } catch (Exception $e) {
            
        }
    }

    public function addAction() {
        $form = new Admin_Form_User();


        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            $form->getElement('email')
                    ->addValidator('Db_NoRecordExists', false, array('table' => 'user',
                        'field' => 'email',
                        'messages' => array(
                            'recordFound' => 'Email này đã tồn tại rồi'
                        ),
                        'exclude' => array('field' => 'id', 'value' => $formData['id'])));
//            if (isset($formData['nganhnghe_id'])){
//                $nganhnghe_ids=$formData['nganhnghe_id'];
//                unset($formData['nganhnghe_id']);
//            }
//            else{
//                $nganhnghe_ids=array();
//            }
            if ($form->isValid($formData)) {
                unset($formData['for_confirm']);
                $mapper = new Default_Model_User();
                $this->processSpecialInput($form, $formData);

                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }

                $formData['password'] = sha1($formData['email']);

                if ($id = $mapper->insert($formData)) {

//                    if(is_array($nganhnghe_ids)&&count($nganhnghe_ids)>0){
//                        foreach ($nganhnghe_ids as $nganhnghe_id){
//                            Core_Db_Table::getDefaultAdapter()->query('insert into nganhnghe_question values ('.$nganhnghe_id.','.$id.')')->execute();                        
//                        }    
//                    }


                    Core::message()->addSuccess('Thêm mới thành công');
                    $this->_helper->redirector('index', 'user', 'admin');
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
        $mapper = new Default_Model_User();
        $row = $mapper->fetchRow($where);
        $row = $row->toArray();
        $form = new Admin_Form_User();

        if ($this->_request->isPost() && isset($_POST['for_confirm'])) {

            $formData = $this->_request->getPost();
            $form->getElement('email')
                    ->addValidator('Db_NoRecordExists', false, array('table' => 'user',
                        'field' => 'email',
                        'messages' => array(
                            'recordFound' => 'Email này đã tồn tại rồi'
                        ),
                        'exclude' => array('field' => 'id', 'value' => $formData['id'])));
            unset($formData['for_confirm']);
//            if (isset($formData['dap_an'])){
//                $dap_an=$formData['dap_an'];
//                unset($formData['dap_an']);
//                $formData['has_dap_an']='1';
//            }
//            else{
//                $dap_an=NULL;
//            }
//            
//            if (isset($formData['nganhnghe_id'])){
//                $nganhnghe_ids=$formData['nganhnghe_id'];
//                unset($formData['nganhnghe_id']);
//            }
//            else{
//                $nganhnghe_ids=array();
//            }

            if ($form->isValid($formData)) {

                $this->processSpecialInput($form, $formData);

                $row = $mapper->fetchRow('id=' . $formData['id']);

                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }



                $mapper->update($formData, 'id=' . $formData['id']);
//                if($dap_an!=NULL){
//                    Core_Db_Table::getDefaultAdapter()->query('delete from dap_an where question_id='.$formData['id'])->execute();
//                    Core_Db_Table::getDefaultAdapter()->query('insert into dap_an values ('.$dap_an.','.$formData['id'].')')->execute();
//                }
//                
//                Core_Db_Table::getDefaultAdapter()->query('delete from nganhnghe_question where question_id='.$formData['id'])->execute();
//                if(is_array($nganhnghe_ids)&&count($nganhnghe_ids)>0){
//                    foreach ($nganhnghe_ids as $nganhnghe_id){
//                        Core_Db_Table::getDefaultAdapter()->query('insert into nganhnghe_question values ('.$nganhnghe_id.','.$formData['id'].')')->execute();                        
//                    }                    
//                    
//                }

                Core::message()->addSuccess('Sửa thành công');
                $this->_helper->redirector('index', 'user', 'admin');
            } else {
                $form->populate($formData);
//                if($dap_an!=NULL){
//                    $this->view->dap_an=$dap_an;
//                }
            }
        } else {
            $form->setDefaults($row);
        }
        $this->view->form = $form;
        $this->render('add');
    }

    public function deleteAction() {
        $id = $this->_request->getParam('id', null);

        Zend_Loader::loadFile('Numeric.php', "./../library/Core/Common/", true);
        if (Numeric::isInteger($id) == FALSE) {
            $this->_helper->redirector('index', 'user', 'admin');
            return;
        }

        $where = "id=$id";
        $mapper = new Default_Model_User();

        $mapper->delete($where);

        Core::message()->addSuccess('Xóa thành công');
        $this->_helper->redirector('index', 'user', 'admin');
    }

}
