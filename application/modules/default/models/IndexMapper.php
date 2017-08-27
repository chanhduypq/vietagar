<?php

class Default_Model_IndexMapper{
	
	
      
        
	
	public function create($formData,$option = array()){
		$model = Core::single('Default/Index');
		foreach ($formData as $key => $value) {
			if ($value == null || $value == '') {
				unset($formData[$key]);
			}
		}				
		return $model->insert($formData);
	}
	
	public function update($formData,$option = array()){
		$model = Core::single('Default/Index');                
		foreach ($formData as $key => $value) {
			if ($value == null || $value == '') {
				unset($formData[$key]);
			}
		}
		try{
			$model->update($formData,array('id_mat_hang = ?'=>$formData['id_mat_hang']));
		}
		catch (Exception $e){
			return false;
		}
		return true;
	}
        public function deleteItem($item_id){
		$db=  Core_Db_Table::getDefaultAdapter();
		$row=$db->fetchRow('select logo from mat_hang where id_mat_hang='.$item_id);
		$file_name=$row['logo'];
		try{
			$db->delete('mat_hang','id_mat_hang='.$item_id);
			$result=true;
		}
		catch (Exception $e){
			$result=false;
		}
		return array('logo'=>$file_name,'result'=>$result);
	}
	
	public function listItems($limit=null, $start=null,$option = array()){
		$select = Core::single('Default/Index')->select();					 			
		$select		
                ->order("ngay_them_moi desc")        
		;
                if(is_numeric($limit)&&  is_numeric($start)){
                    $select->limit($limit, $start);
                }
                if(is_array($option)&&count($option)>0){
                    foreach ($option as $opt){
                        if(count($opt)==3){
                            $select->where($opt[0],$opt[1],$opt[2]);
                        }
                        else if(count($opt)==2){
                            $select->where($opt[0],$opt[1]);
                        }
                        else if(count($opt)==1){
                            $select->where($opt[0]);
                        }
                        
                    }
                    
                }
                //echo $select->__toString();exit;
		$rows = $select->fetchAll();	 
		$this->_countItems = $select->count();                
		return $rows;
	}
	
	
	
}