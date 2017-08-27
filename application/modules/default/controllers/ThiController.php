<?php

class ThiController extends Core_Controller_Action {

    private $user_id = null;

    public function init() {
        parent::init();
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('login', 'index', 'default');
        } else {
            $identity = $auth->getIdentity();
            $this->user_id = $identity['id'];
        }
    }

    private function saveDB($data) {
        $db = Core_Db_Table::getDefaultAdapter();
        $modelUserExam = new Default_Model_Userexam();
        $userExamId = $modelUserExam->insert(
                array(
                    'user_id' => $this->user_id,
                    'nganh_nghe_id' => $data['nganh_nghe_id_form2'],
                    'level' => $data['level_form2'],
                    'exam_date' => date("Y-m-d H:i:s")
                )
        );
        $sql = 'INSERT INTO user_exam_detail (user_exam_id,question_id,answer_id,is_correct,answer_sign,dapan_sign) VALUES ';
        $i = 0;
        $questionIds = $data['question_id'];
        $answerIds = $data['answer_id'];
        $answerSigns = $data['answer_sign'];
        $dapanSigns = $data['dapan_sign'];
        $count_correct = 0;
        for ($i = 0, $n = count($questionIds); $i < $n; $i++) {
            if ($answerSigns[$i] == $dapanSigns[$i]) {
                $is_correct = 1;
                $count_correct++;
            } else {
                $is_correct = 0;
            }
            $sql .= "($userExamId," . $questionIds[$i] . "," . $answerIds[$i] . ",$is_correct,'" . $answerSigns[$i] . "','" . $dapanSigns[$i] . "')";
            if ($i < count($questionIds) - 1) {
                $sql .= ",";
            }
        }

        $db->query($sql)->execute();

        if ($count_correct >= ceil(count($questionIds) / 2)) {
            $user_pass = new Default_Model_Userpass();
            $user_pass->insert(array(
                'user_id' => $this->user_id,
                'nganh_nghe_id' => $data['nganh_nghe_id_form2'],
                'level' => $data['level_form2'],
                'user_exam_id' => $userExamId,
            ));
        }

    }
    
    private function unsetSessionExaming(){
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();
        $auth->clearIdentity();

        unset($identity['examing']);
        unset($identity['time_start']);
        unset($identity['level']);
        unset($identity['nganh_nghe_id']);

        $auth->getStorage()->write($identity);
    }
    
    public function unsetsessionexamingAction(){
        $this->unsetSessionExaming();
    }

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        $db = Core_Db_Table::getDefaultAdapter();     
        
        $data = $this->_request->getPost();
        if (count($data)>0) {
            if(isset($data['question_id'])){
                $this->saveDB($data);
                $this->unsetSessionExaming();
                $this->_helper->redirector('index', 'index', 'default');
                return;
            }
            else{
                   
                $newQuestions = array();
                $nganhNgheId =$data['nganh_nghe_id'];
                $level =$data['level'];
                $identity = $auth->getIdentity();  
                if(isset($identity['examing'])&&$identity['examing']==true){
                    $nganhNgheId =$identity['nganh_nghe_id'];
                    $level =$identity['level'];
                }
                
                $count = $db->fetchOne('SELECT count(*) FROM user_pass WHERE user_id=' . $this->user_id . ' AND nganh_nghe_id=' . $nganhNgheId . ' AND level=' . $level);
                if ($count != '0') {
                    $this->view->error = 'Bạn đã thi đỗ ngành nghề ứng với cấp bậc này rồi';
                } else {
                    
                    $this->view->error = '';
                    $questions = $db->fetchAll("SELECT question.id,question.content,answer.sign,answer.content AS answer_content,answer.id AS answer_id,dap_an.sign AS dapan_sign FROM question JOIN nganhnghe_question ON question.id = nganhnghe_question.question_id JOIN answer ON answer.question_id=question.id JOIN dap_an ON dap_an.question_id=question.id WHERE nganhnghe_question.nganhnghe_id=$nganhNgheId AND question.level=$level ORDER BY question.id ASC,answer.sign ASC");

                    foreach ($questions as $question) {
                        $newQuestions[$question['id']]['id'] = $question['id'];
                        $newQuestions[$question['id']]['content'] = $question['content'];
                        $newQuestions[$question['id']]['answers'][] = array('content' => $question['answer_content'], 'sign' => $question['sign'], 'id' => $question['answer_id']);
                        $newQuestions[$question['id']]['dapan_sign'] = $question['dapan_sign'];
                    }

                    $identity = $auth->getIdentity();  
                    $auth->clearIdentity();   
                    if(!isset($identity['examing'])||$identity['examing']==FALSE){
                        $identity['examing'] = true;
                        $identity['time_start'] = time();
                        $identity['nganh_nghe_id'] = $nganhNgheId;
                        $identity['level'] = $level;
                    }                
                    $auth->getStorage()->write($identity);
                    
                }
                
                
            }
        }
        else{
            $identity = $auth->getIdentity();            

            if(isset($identity['examing'])&&$identity['examing']==true){
                $level=$identity['level'];
                $nganhNgheId=$identity['nganh_nghe_id'];
                $newQuestions = array();
                $questions = $db->fetchAll("SELECT question.id,question.content,answer.sign,answer.content AS answer_content,answer.id AS answer_id,dap_an.sign AS dapan_sign FROM question JOIN nganhnghe_question ON question.id = nganhnghe_question.question_id JOIN answer ON answer.question_id=question.id JOIN dap_an ON dap_an.question_id=question.id WHERE nganhnghe_question.nganhnghe_id=$nganhNgheId AND question.level=$level ORDER BY question.id ASC,answer.sign ASC");

                foreach ($questions as $question) {
                    $newQuestions[$question['id']]['id'] = $question['id'];
                    $newQuestions[$question['id']]['content'] = $question['content'];
                    $newQuestions[$question['id']]['answers'][] = array('content' => $question['answer_content'], 'sign' => $question['sign'], 'id' => $question['answer_id']);
                    $newQuestions[$question['id']]['dapan_sign'] = $question['dapan_sign'];
                }

            }
            else{
                $nganhNgheId=$level=0;
                $newQuestions = array();
            }
            
        }
        
        
        $identity = $auth->getIdentity();

        if(isset($identity['examing'])&&$identity['examing']==true){
            $miniutes=(time()-$identity['time_start'])/60;                
            $miniutes= round($miniutes,0);            
        }
        else{
            $miniutes=0;
        }        
        
        $this->view->questions = $newQuestions;
        $this->view->nganhNghes = $db->fetchAll('SELECT * FROM nganh_nghe');
        $this->view->nganhNgheId = $nganhNgheId;
        $this->view->level = $level;
        $this->view->miniutes = $miniutes;
    }

}
