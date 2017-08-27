<?php

class Default_Model_User extends Core_Db_Table_Abstract {

    public $_name="user";    
    public function __construct() {
        parent::__construct();
             
    }
    
    public function getUsers(&$total,$limit = null, $start = null) {                 
        
        Zend_Loader::loadFile('Numeric.php', "./../library/Core/Common/", true);
        if (Numeric::isInteger($limit) && Numeric::isInteger($start)) {
            $items=  $this->select("*")->order(array('id'))->limit($limit, $start)->fetchAll();
            
        }
        else {
            $items=  $this->select("*")->order(array('id'))->fetchAll(); 
        }
        
        $total= $this->select("count(*)")->fetchOne();

        return $items;
    }   
    public function getUsersNotOneId($id) {                 
        $items=  $this->select("*")->where("id <> $id")->fetchAll();  
        return $items;
    }   
    public function getUser($id) {                 
        $item=  $this->select("*")->where("id=$id")->fetchRow();
        return $item;       
    }   
    
   
    

}

?>