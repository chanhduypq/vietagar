<?php

class Admin_QuestionController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index', 'index', 'admin');
        }
    }

    private function sheetData($sheet) {
//        $re = '<table>';     

        $x = 7;
        
        while ($x <= $sheet['numRows']) {
//            $re .= "<tr>\n";
//            $y = 2;
//            while ($y <= $sheet['numCols']) {
//                $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
//                $re .= " <td>$cell</td>\n";
//                $y++;
//            }
//            $re .= "</tr>\n";
            
            
            $mapper_question=new Default_Model_Question();
            if(strtoupper(trim($sheet['cells'][$x][2]))=='SC'){
                $level= Default_Model_Question::SO_CAP;
            }
            else if(strtoupper(trim($sheet['cells'][$x][2]))=='TC'){
                $level= Default_Model_Question::TRUNG_CAP;
            }
            else if(strtoupper(trim($sheet['cells'][$x][2]))=='CC'){
                $level= Default_Model_Question::CAO_CAP;
            }
            $data_question=array(
                'content'=>$sheet['cells'][$x][6],
                'has_full_answer'=>1,
                'has_dap_an'=>1,
                'level'=>$level,
            );
            $id_question=$mapper_question->insert($data_question);
            
            $mapper_nganhnghe_question=new Default_Model_NganhngheQuestion();
            for($i=9;$i<=19;$i++){
                if (isset($sheet['cells'][$x][$i]) && trim($sheet['cells'][$x][$i]) == '1') {

                    $mapper_nganhnghe_question->insert(array(
                        'nganhnghe_id'=>($i-8),
                        'question_id'=>$id_question,
                    ));
                }
            }            
            
            $mapper_dapan=new Default_Model_Dapan();
            for($i=1;$i<=4;$i++){
                $mapper_answer=new Default_Model_Answer();
                if($i==1){
                    $sign='A';
                }
                else if($i==2){
                    $sign='B';
                }
                else if($i==3){
                    $sign='C';
                }
                else if($i==4){
                    $sign='D';
                }
                $data_answer=array(
                    'content'=>$sheet['cells'][$x+$i][6],
                    'question_id'=>$id_question,
                    'sign'=>$sign
                );
                $id_answer=$mapper_answer->insert($data_answer);
                if(trim($sheet['cells'][$x+$i][7])=='1'){
                    $mapper_dapan->insert(array(
                        'answer_id'=>$id_answer,
                        'question_id'=>$id_question,
                        'sign'=>$sign
                    ));
                }
            }
            $x+=5;
            
        }

//        return $re . '</table>';     // ends and returns the html table
    }

    private function importExcel($file_name) {
        require_once 'excel_reader.php';
        $excel = new PhpExcelReader();
        $excel->setOutputEncoding('UTF-8');
        $excel->read($file_name);
        
        
        $this->sheetData($excel->sheets[0]);

//        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
//        $excel_data = '';              // to store the the html tables with data of each sheet
//// traverses the number of sheets and sets html table with each sheet data in $excel_data
//        for ($i = 0; $i < $nr_sheets; $i++) {
//            $excel_data .= '<h4>Sheet ' . ($i + 1) . ' (<em>' . $excel->boundsheets[$i]['name'] . '</em>)</h4>' . $this->sheetData($excel->sheets[$i]) . '<br/>';
//        }
//echo '<meta http-equiv="content-type" content="text/html;charset=utf-8;" />';
//        echo $excel_data;      // outputs HTML tables with excel file data


        exit;
    }

    public function indexAction() {
//        set_time_limit(1000);
//        $this->importExcel('516CauhoitracnghiemAT_2017.xls');
        $limit = $this->_getParam('limit', 5);






        $page = $this->_getParam('page', 1);


        $start = (($page - 1) * $limit);
        $mapper = new Default_Model_Question();
        $rows = $mapper->getMatHangs($total, $limit, $start);
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

    public function addAction() {
        $form = new Admin_Form_Question();


        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if (isset($formData['nganhnghe_id'])) {
                $nganhnghe_ids = $formData['nganhnghe_id'];
                unset($formData['nganhnghe_id']);
            } else {
                $nganhnghe_ids = array();
            }
            if ($form->isValid($formData)) {
                unset($formData['for_confirm']);
                $mapper = new Default_Model_Question();


                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }

                if ($id = $mapper->insert($formData)) {

                    if (is_array($nganhnghe_ids) && count($nganhnghe_ids) > 0) {
                        foreach ($nganhnghe_ids as $nganhnghe_id) {

                            $mapper_nganhnghe_question=new Default_Model_NganhngheQuestion();
                            $mapper_nganhnghe_question->insert(array(
                                            'nganhnghe_id'=>$nganhnghe_id,
                                            'question_id'=>$id,
                                        ));
                        }
                    }


                    Core::message()->addSuccess('Thêm mới thành công');
                    $this->_helper->redirector('index', 'question', 'admin');
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

    public function addanswerAction() {
        $question_id = $this->_getParam("question_id", "");

        $form = new Admin_Form_Answer();
        $form->getElement('question_id')->setValue($question_id);

        if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                unset($formData['for_confirm']);
                $mapper = new Default_Model_Answer();


                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }

                $formData['sign'] = strtoupper($formData['sign']);

                if ($mapper->insert($formData)) {

                    Core_Db_Table::getDefaultAdapter()->update('question', array('has_full_answer' => 1), 'id=' . $formData['question_id']);
                    Core::message()->addSuccess('Thêm mới thành công');
                    $this->_helper->redirector('index', 'question', 'admin');
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

    public function editAction() {

        $id_mat_hang = $this->_getParam('id');
        $where = "id=$id_mat_hang";
        $mapper = new Default_Model_Question();
        $row = $mapper->fetchRow($where);
        $row = $row->toArray();
        $form = new Admin_Form_Question();
        if ($this->_request->isPost() && isset($_POST['for_confirm'])) {

            $formData = $this->_request->getPost();
            unset($formData['for_confirm']);
            if (isset($formData['dap_an'])) {
                $dap_an = $formData['dap_an'];
                unset($formData['dap_an']);
                $formData['has_dap_an'] = '1';
            } else {
                $dap_an = NULL;
            }

            if (isset($formData['nganhnghe_id'])) {
                $nganhnghe_ids = $formData['nganhnghe_id'];
                unset($formData['nganhnghe_id']);
            } else {
                $nganhnghe_ids = array();
            }

            if ($form->isValid($formData)) {



                $row = $mapper->fetchRow('id=' . $formData['id']);

                foreach ($formData as $key => $value) {
                    if ($value == "") {
                        $formData["$key"] = NULL;
                    }
                }

                $mapper->update($formData, 'id=' . $formData['id']);
                if ($dap_an != NULL) {
                    Core_Db_Table::getDefaultAdapter()->query('delete from dap_an where question_id=' . $formData['id'])->execute();
                    $mapper_dapan=new Default_Model_Dapan();
                    $mapper_dapan->insert(array(
                        'answer_id'=>$dap_an,
                        'question_id'=>$formData['id'],
                    ));

                }

                Core_Db_Table::getDefaultAdapter()->query('delete from nganhnghe_question where question_id=' . $formData['id'])->execute();
                if (is_array($nganhnghe_ids) && count($nganhnghe_ids) > 0) {
                    $mapper_nganhnghe_question=new Default_Model_NganhngheQuestion();
                    foreach ($nganhnghe_ids as $nganhnghe_id) {
                        
                        $mapper_nganhnghe_question->insert(array(
                                    'nganhnghe_id'=>$nganhnghe_id,
                                    'question_id'=>$formData['id'],
                                ));

                    }
                }

                Core::message()->addSuccess('Sửa thành công');
                $this->_helper->redirector('index', 'question', 'admin');
            } else {
                $form->populate($formData);
                if ($dap_an != NULL) {
                    $this->view->dap_an = $dap_an;
                }
            }
        } else {
            $form->setDefaults($row);
        }
        $this->view->form = $form;
        $this->render('add');
    }

    public function editanswerAction() {

        $id_mat_hang = $this->_getParam('id');
        $where = "id=$id_mat_hang";
        $mapper = new Default_Model_Answer();
        $row = $mapper->fetchRow($where);
        $row = $row->toArray();
        $form = new Admin_Form_Answer();
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
//                if ($row['parent_id'] == "" || $row['parent_id'] == "0") {
//                    $child_id_array = $this->_getParam("child", "");
//
//                    $menus_temp = $mapper->getChildren($id_mat_hang);
//                    if (is_array($menus_temp) && count($menus_temp) > 0) {
//                        $array = array();
//                        foreach ($menus_temp as $value) {
//                            $array[] = $value['id'];
//                        }
//                        $k = 1;
//                        for ($j = 0; $j < count($child_id_array); $j++) {
//                            if (in_array($child_id_array[$j], $array)) {
//                                Core_Db_Table::getDefaultAdapter()->query("update nganh_nghe set `order`=" . ($k++) . " where id=" . $child_id_array[$j])->execute();
//                            }
//                        }
//                    }
//                }

                $formData['sign'] = strtoupper($formData['sign']);
                $mapper->update($formData, 'id=' . $formData['id']);
                Core::message()->addSuccess('Sửa thành công');
                $this->_helper->redirector('index', 'question', 'admin');
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
        $answer_id = $this->_request->getParam('answer_id', null);
        $question_id = $this->_request->getParam('question_id', null);

        Zend_Loader::loadFile('Numeric.php', "./../library/Core/Common/", true);
        if (Numeric::isInteger($answer_id) == FALSE && Numeric::isInteger($question_id) == FALSE) {
            $this->_helper->redirector('index', 'question', 'admin');
            return;
        }

        if (Numeric::isInteger($question_id)) {
            $where = "id=$question_id";
            $mapper = new Default_Model_Question();

            $mapper->delete($where);

            $mapper = new Default_Model_Answer();
            $where = "question_id=$question_id";
            $mapper->delete($where);
        } else if (Numeric::isInteger($answer_id)) {
            $mapper = new Default_Model_Answer();

            $where = "id=$answer_id";
            $row = $mapper->fetchRow($where);
            $mapper->delete($where);
            $answers = $mapper->fetchAll('question_id=' . $row['question_id']);

            if (count($answers) == 0) {
                Core_Db_Table::getDefaultAdapter()->update('question', array('has_full_answer' => 0, 'has_dap_an' => 0), 'id=' . $row['question_id']);
            }
        }


        Core::message()->addSuccess('Xóa thành công');
        $this->_helper->redirector('index', 'question', 'admin');
    }

}
