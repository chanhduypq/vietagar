<?php
class Default_Model_Lienhe{ 
      
       public static function getLienhe($language){
         $db=  Zend_Db_Table_Abstract::getDefaultAdapter();
         $result=$db->fetchRow("select noidung_$language from lienhe");
         return $result['noidung'];
      } 
      
                     
      
      
      
      
        
}