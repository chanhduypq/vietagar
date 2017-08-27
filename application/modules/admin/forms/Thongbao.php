<?php
/**
* @file: Categories.php
* @author: huuthanh3108@gmaill.com
* @date: 11-10-2012
* @company : http://dnict.vn
**/
class Admin_Form_Thongbao extends Core_Form{	
	public function init(){
		parent::init();		
		$sub_form1=new Core_Form();
		$sub_form1->buildElementsAutoForFormByTableName('thongbao');
		$sub_form1->getElement('noidung')->setLabel('Nội dung:');
		$sub_form2=new Core_Form();
		$sub_form2->buildElementsAutoForFormByFileTableName('file_thong_bao');
		$sub_form2->getElement('file_content')->setLabel('Chọn file:');
		 
		$this->addSubForms(array(
				           $sub_form1,
				           $sub_form2
				           )
		);
		
	}
}