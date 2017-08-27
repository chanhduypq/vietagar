<?php
class Admin_Model_LienheMapper{



	public function save($data){
		try{
			$this->getDB()->update('lienhe', $data);
		}
		catch (Exception $e){
			return false;
		}
		return true;
	}
	public function getNoiDung(){
		
		try{
			$ret=$this->getDB()->fetchRow("select * from lienhe");
			

		}
		catch (Exception $e){
			return array();
		}
		return $ret;
	}
	private function getDB(){
		$db=Core_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		return $db;
	}




}