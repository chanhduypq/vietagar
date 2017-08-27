<?php          
class Admin_Model_ThongbaoMapper{
	public function create($formData,$option = array()){
		$model = Core::single('Admin/Thongbao');
		foreach ($formData as $key => $value) {
			if ($value == null || $value == '') {
				unset($formData[$key]);
			}
		}
		$db=$this->getDB();		
		$db->insert('thongbao', array('noidung'=>$formData['noidung']));		
		unset($formData['noidung']);
		$db->query("SET GLOBAL max_allowed_packet=128M;");
		return $db->insert("file_thong_bao",$formData);
		//return $model->insert($formData);
		
	} 
	public function read(){
		return $this->getDB()->fetchAll("select id_file_thong_bao,name from file_thong_bao");		
		$model = Core::single('Admin/Thongbao');
		return $model->fetchAll()->toArray();
	}
      
    public  function utf8convert($str) {
    
    	if(!$str) return false;
    
    	$utf8 = array(
    
    			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
    
    			'd'=>'đ|Đ',
    
    			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
    
    			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
    
    			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
    
    			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
    
    			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    
    	);
    
    	foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
    
    	return $str;
    
    }
    public function getMaxIDFileThongBao(){
        $row=$this->getDB()->fetchRow("select max(id_file_thong_bao) as max from file_thong_bao");
        return $row['max'];
    }
   
      public function saveFileThongBao($fileNames,$fileContents,$fileContentTypes,$fileLengths){
          $idMax=$this->getMaxIDFileThongBao();
          set_time_limit(3000);
          ini_set("memory_limit",-1);
          $db=$this->getDB();          
          if(!is_array($fileNames)||count($fileNames)==0){
              return true;
          }
          for($i=0,$n=count($fileNames);$i<$n;$i++){
              $data=array(
              		"filename"=>$fileNames[$i],
              		"filecontent"=>$fileContents[$i],
              		"filecontenttype"=>$fileContentTypes[$i],
              		"filelength"=>$fileLengths[$i],
              		"id_file_thong_bao"=>++$idMax
              );
              try{
                  $db->query("SET GLOBAL max_allowed_packet=50777216;");
                  $db->insert("file_thong_bao",$data);       
              }
              catch (Exception $e){              	
              	return false;
              }
          }      
          return true;
      }
      public function saveNoiDung($noidung){
          $db=$this->getDB();
          if($noidung==null||trim($noidung)==""){
              $db->delete("thongbao");
              return true;
          }
          $row=$db->fetchRow("select count(*) as count from thongbao");
          if($row['count']>0){
              $db->update("thongbao",array('noidung'=>$noidung));
          }
          else{
              $db->insert("thongbao",array('noidung'=>$noidung));
          }
          
          return true;
      }
      public function deleteFileThongBao($id_file_thong_bao_cus){
      	$db=$this->getDB();
      	if(!is_array($id_file_thong_bao_cus)||count($id_file_thong_bao_cus)==0){
      	    return true;
      	}      
      	try {
      	    $db->delete("file_thong_bao","id_file_thong_bao IN (".implode(",", $id_file_thong_bao_cus).")");
      	}
      	catch (Exception $e){return false;}
      	return true;
      }
      
      public function getFile($id_file_thong_bao){
      	try{
      		$ret=$this->getDB()->fetchRow("select * from file_thong_bao where id_file_thong_bao=$id_file_thong_bao");
      		return $ret;      
      	}
      	catch (Exception $e){
      		return array();
      	}
      	return array();
      
      }
      public function getThongBao(){  
          $temp='';                  
          try{
             $ret=$this->getDB()->fetchRow("select noidung from thongbao");
             $temp=$ret['noidung'];
                        
          }
          catch (Exception $e){
             return '';
          }
          return $temp;
      }
      private function getDB(){          
        $db=Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);        
        return $db;       
      }  
      
      
      
        
}