<?php

class Default_Model_Answer extends Core_Db_Table_Abstract {

    public $_name="answer";    
    public function __construct() {
        parent::__construct();
             
    }
    public function autoComplete($string,$language, $limit = 10) {
        $items=  $this->select("ten_mat_hang_$language")->where("ten_mat_hang_$language like '%$string%'")->limit($limit)->fetchAll();         
        return $items;
    }
    public function getAnswers($question_id) {                 
        $items=  $this->select("*")->where('question_id='.$question_id)->order('sign')->fetchAll();          
        return $items;
    }   
    
    public function getAnswer($id) {                 
        $item=  $this->select("*")->where("id=$id")->fetchRow();
        return $item;       
    }   
      
    

}

?>