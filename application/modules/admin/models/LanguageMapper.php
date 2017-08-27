<?php
class Admin_Model_LanguageMapper{



	public function save($data,$where){
		try{
			$this->getDB()->update('language', $data,$where);
		}
		catch (Exception $e){
			return false;
		}
		return true;
	}
	public function getData(){
		$row=$this->getDB()->fetchAll("select * from language order by `language`.`order`");
		return $row;
	}
	private function getDB(){
		$db=Core_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		return $db;
	}




}