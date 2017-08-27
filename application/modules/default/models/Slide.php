<?php

class Default_Model_Slide extends Core_Db_Table_Abstract {

    public $_name="slide_text";    
    public function __construct() {
        parent::__construct();
             
    }
    public function getMatHangs() {                 
        $items=  $this->select("*")->fetchAll();        
        return $items;
    }   
    
    public function getMatHang($id) {                 
        $item=  $this->select("*")->where("id=$id")->fetchRow();
        return $item;       
    }   
    

}

?>