<?php
class Admin_Model_HinhnenMapper{
	public function save($formData){
		foreach ($formData as $key => $value) {
			if ($value == null || $value == '') {
				unset($formData[$key]);
			}
		}
		try{
			$row=$this->getDB()->fetchRow("select file_name from hinh_nen");
			$file_name='';
			if(null!==$row&&is_array($row)&&count($row)>0&&$row['file_name']!=""){
				$file_name=$row['file_name'];
				$this->getDB()->update('hinh_nen', $formData);
			}
			else{
				$this->getDB()->insert('hinh_nen', $formData);
			}
		}
		catch (Exception $e){
			return array('success'=>false,'file_name'=>$file_name);
		}
		return array('success'=>TRUE,'file_name'=>$file_name);
	}
	
	private function getDB(){
		$db=Core_Db_Table::getDefaultAdapter();
		$db->setFetchMode(Zend_Db::FETCH_ASSOC);
		return $db;
	}




}