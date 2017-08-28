<?php

/**
 * @file: Categories.php
 * @author: huuthanh3108@gmaill.com
 * @date: 11-10-2012
 * @company : http://dnict.vn
 * */
class Admin_Form_Mathang extends Core_Form {

    public function init() {
        parent::init();


//		require_once 'Zend/Skoch/Filter/File/Resize.php';
        $logo = new Core_Form_Element_File('logo');

        $logo
                ->setForInsertDB(false)
                ->setPathStoreFile('/images/database/')
                ->setDestination(UPLOAD . "/public/images/database/")
                ->setValidateExtensiton(array('gif', 'jpg', 'jpeg', 'png'))
                ->setLabel('Chọn hình ảnh:')

        ;
        $parent_id = new Core_Form_Element_Hidden("parent_id");
//                $logo->addFilter(new Skoch_Filter_File_Resize(array(
//                    'width' => 200,
//                    'height' => 300,
//                    'keepRatio' => true,
//                )));



        $this->buildElementsAutoForFormByTableName('mat_hang');

        $this->getElement('ten_mat_hang_vi')->setLabel('Tên mặt hàng:');
        $this->getElement('mo_ta_vi')->setLabel('Mô tả:');
        $this->getElement('title_vi')->setLabel('Tiêu đề:');
        $this->getElement('loi_gioi_thieu_vi')->setLabel('Lời giới thiệu:');
        $this->getElement('ten_mat_hang_cn')->setLabel('Tên mặt hàng:');
        $this->getElement('mo_ta_cn')->setLabel('Mô tả:');
        $this->getElement('title_cn')->setLabel('Tiêu đề:');
        $this->getElement('loi_gioi_thieu_cn')->setLabel('Lời giới thiệu:');
        $this->getElement('ten_mat_hang_en')->setLabel('Tên mặt hàng:');
        $this->getElement('mo_ta_en')->setLabel('Mô tả:');
        $this->getElement('title_en')->setLabel('Tiêu đề:');
        $this->getElement('loi_gioi_thieu_en')->setLabel('Lời giới thiệu:');

        $this->removeElement('gia');
        $this->removeElement('public_gia');
        $this->removeElement('logo');
        $this->addElement($logo);
        $this->removeElement('parent_id');
        $this->addElement($parent_id);
    }

}
