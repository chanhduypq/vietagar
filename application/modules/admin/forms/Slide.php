<?php

/**
 * @file: Categories.php
 * @author: huuthanh3108@gmaill.com
 * @date: 11-10-2012
 * @company : http://dnict.vn
 * */
class Admin_Form_Slide extends Core_Form {

    public function init() {
        parent::init();






        $this->buildElementsAutoForFormByTableName('slide_text');

        
        $this->getElement('mo_ta_vi')->setLabel('Mô tả:');
        $this->getElement('title_vi')->setLabel('Tiêu đề:');
        
        $this->getElement('mo_ta_cn')->setLabel('Mô tả:');
        $this->getElement('title_cn')->setLabel('Tiêu đề:');
        
        $this->getElement('mo_ta_en')->setLabel('Mô tả:');
        $this->getElement('title_en')->setLabel('Tiêu đề:');
       
    }

}
