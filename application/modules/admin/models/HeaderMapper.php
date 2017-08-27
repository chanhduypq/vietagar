<?php
class Admin_Model_HeaderMapper{



	public function save($data){
		try{
                    $this->getDB()->update('header_text_dynamic',array("dynamic"=>$data['dynamic']));
                    unset($data['dynamic']);
			$this->getDB()->update('header_text', $data);
		}
		catch (Exception $e){
			return false;
		}
		return true;
	}
	public function getData(){
		$row=$this->getDB()->fetchRow("select * from header_text");
		return $row;
	}
        public function getDynamic(){
		$row=$this->getDB()->fetchRow("select dynamic from header_text_dynamic");
                return $row['dynamic'];
		
	}
	private function getDB(){
		$db=Core_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		return $db;
	}




}