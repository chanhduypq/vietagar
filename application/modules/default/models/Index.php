<?php

class Default_Model_Index extends Core_Db_Table_Abstract {

    public $_name="mat_hang";    
    public function __construct() {
        parent::__construct();
             
    }
    public function autoComplete($string,$language, $limit = 10) {
        $items=  $this->select("ten_mat_hang_$language")->where("ten_mat_hang_$language like '%$string%'")->limit($limit)->fetchAll();         
        return $items;
    }
    public function getMatHangs($only_parent=true) {                 
        $items=  $this->select("*")->where("parent_id is null")->fetchAll();  
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
    public function getMatHangsNotOneId($id,$only_parent=true) {                 
        $items=  $this->select("*")->where("parent_id is null and id <> $id")->fetchAll();  
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
    public function getChildren($parent_id) {   
        if(!is_numeric($parent_id)){
            return array();
        }
        $items=  $this->select("*")->where("parent_id=$parent_id")->fetchAll();   
        return $items;
    }  
    

}

?>