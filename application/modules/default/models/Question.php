<?php

class Default_Model_Question extends Core_Db_Table_Abstract {

    const SO_CAP='1';
    const TRUNG_CAP='2';
    const CAO_CAP='3';

    public $_name="question";    
    public function __construct() {
        parent::__construct();
             
    }
    public function autoComplete($string,$language, $limit = 10) {
        $items=  $this->select("ten_mat_hang_$language")->where("ten_mat_hang_$language like '%$string%'")->limit($limit)->fetchAll();         
        return $items;
    }
    public function getMatHangs(&$total,$limit = null, $start = null) {                 
        
        Zend_Loader::loadFile('Numeric.php', "./../library/Core/Common/", true);
        if (Numeric::isInteger($limit) && Numeric::isInteger($start)) {
            $items=  $this->select("*")->order(array('id','has_full_answer','has_dap_an'))->limit($limit, $start)->fetchAll();
            
        }
        else {
            $items=  $this->select("*")->order(array('id','has_full_answer','has_dap_an'))->fetchAll(); 
        }
        
        $total= $this->select("count(*)")->fetchOne();
        
        
        for($i=0,$n=count($items);$i<$n;$i++){
            $items[$i]['answers']= $this->getAnswers($items[$i]['id']);
        }
        return $items;
    }   
    public function getMatHangsNotOneId($id,$only_parent=true) {                 
        $items=  $this->select("*")->where("id <> $id")->fetchAll();  
        if($only_parent==TRUE){
            return $items;
        }
        $result=array();
        for($i=0,$n=count($items);$i<$n;$i++){
            $result[]=$items[$i];
            $children=  $this->getChildren($items[$i]['id']);
            if(is_array($children)&&count($children)>0){
                foreach ($children as $child){
                    $result[]=$child;
                }
            }
        }
        return $result;
    }   
    public function getMatHang($id) {                 
        $item=  $this->select("*")->where("id=$id")->fetchRow();
        return $item;       
    }   
    public function getSameTypeMatHangs($id) {                 
        $item=  $this->select("*")->where("id IN (select id from mat_hang where parent_id IN (select parent_id from mat_hang where id=$id)) and id <> $id")->fetchAll();
        if(is_array($item)&&count($item)>0){
            return $item;       
        }
        return array();
    }   
    public function getAnswers($parent_id) {   
        if(!is_numeric($parent_id)){
            return array();
        }
        $mapper=new Default_Model_Answer();
        $items= $mapper->getAnswers($parent_id);
        return $items;
    }  
    

}

?>