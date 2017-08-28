<?php

class Admin_MathangController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
        
    }

    public function indexAction() {
        
        $mapper = new Default_Model_Index("vi");
        $rows = $mapper->getMatHangs($only_parent=FALSE);
        $this->view->items = $rows;
        
        
            
        
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
        $parent_id=  $this->_getParam("parent_id","");
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();        
        $form = new Admin_Form_Mathang();          
        $form->getElement('parent_id')->setValue($parent_id);
        $form->removeElement("ten_mat_hang_vi");
        $form->removeElement("ten_mat_hang_en");
        $form->removeElement("ten_mat_hang_cn");
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {                
                unset($formData['for_confirm']);
                $mapper = new Default_Model_Index();
                $this->processSpecialInput($form, $formData);                 
                
                foreach ($formData as $key=>$value){
                    if($value==""){
                        $formData["$key"]=NULL;
                    }
                }
                if ($mapper->insert($formData)) { 
                    
                    Core::message()->addSuccess('Thêm mới thành công');
                    $this->_helper->redirector('index', 'mathang', 'admin');
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
    public function addchildAction() {
        $parent_id=  $this->_getParam("parent_id","");
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();        
        $form = new Admin_Form_Mathang();          
        $form->getElement('parent_id')->setValue($parent_id);
        $form->removeElement("loi_gioi_thieu_vi");
        $form->removeElement("loi_gioi_thieu_en");
        $form->removeElement("loi_gioi_thieu_cn");
        $form->removeElement("title_vi");
        $form->removeElement("title_en");
        $form->removeElement("title_cn");
        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {                
                unset($formData['for_confirm']);
                $mapper = new Default_Model_Index();
                $this->processSpecialInput($form, $formData);                 
                
                foreach ($formData as $key=>$value){
                    if($value==""){
                        $formData["$key"]=NULL;
                    }
                }
                if ($mapper->insert($formData)) { 
                    
                    Core::message()->addSuccess('Thêm mới thành công');
                    $this->_helper->redirector('index', 'mathang', 'admin');
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
        $this->render('add');
        
        
    }

    private function processFile($new_data, $old_data, $column_names) {
        foreach ($column_names as $column_name) {
            if (file_exists(UPLOAD . '/public' . $new_data[$column_name]) || file_exists(UPLOAD . '/public' . $old_data[$column_name])) {
                if (file_exists(UPLOAD . '/public' . $old_data[$column_name]) && $old_data[$column_name] != $new_data[$column_name]) {
                    unlink((UPLOAD . '/public' . $old_data[$column_name]));
                }
            }
        }
    }
    public function editAction() {

        $id_mat_hang = $this->_getParam('id');
        $where="id=$id_mat_hang";
        $mapper = new Default_Model_Index("vi");        
        $row = $mapper->fetchRow($where);
        $row=$row->toArray();   
        $form = new Admin_Form_Mathang();        
        if($row['parent_id']!=""&&$row['parent_id']!="0"){
            $form->removeElement("loi_gioi_thieu_vi");
            $form->removeElement("loi_gioi_thieu_en");
            $form->removeElement("loi_gioi_thieu_cn");
            $form->removeElement("title_vi");
            $form->removeElement("title_en");
            $form->removeElement("title_cn");            
        }
        else{
            $form->removeElement("ten_mat_hang_vi");
            $form->removeElement("ten_mat_hang_en");
            $form->removeElement("ten_mat_hang_cn");
        }
        
        
        
        if ($this->_request->isPost() && isset($_POST['for_confirm'])) {

            $formData = $this->_request->getPost();
            unset($formData['for_confirm']);
            
            if ($form->isValid($formData)) {                
                $this->processSpecialInput($form, $formData);
                $row=$mapper->fetchRow('id=' . $formData['id']);
                $old_data = $row->toArray();
                foreach ($formData as $key=>$value){
                    if($value==""){
                        $formData["$key"]=NULL;
                    }
                }
                               
                if ($mapper->update($formData, 'id=' . $formData['id'])) {
                    $this->processFile($new_data=$formData, $old_data, array_keys($formData));
                    Core::message()->addSuccess('Sửa thành công');
                    $this->_helper->redirector('index', 'mathang', 'admin');
                } else {
                    $this->view->error = 'Lỗi. Xử lý thất bại.';
                    $form->populate($formData);
                }
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


        $where="id=$item_id";
        $mapper = new Default_Model_Index("vi");
        $row = $mapper->fetchRow($where); 
        $row=$row->toArray();        
        if (is_array($row) && count($row) > 0) {
            foreach ($row as $key => $value) {
                if (file_exists(UPLOAD . "/public" . $value)) {
                    unlink(UPLOAD . "/public" . $value);
                }
            }
        }
        $mapper->delete($where); 
        Core::message()->addSuccess('Xóa thành công');
        $this->_helper->redirector('index', 'mathang', 'admin');
    }

}
