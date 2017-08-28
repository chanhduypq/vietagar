<?php

class Cn_NewsController extends Core_Controller_Action
{

    public function init()
    {
    	parent::init();
    }

    public function indexAction()
    {
        $module_name = $this->_request->getModuleName();
        if ($module_name == 'default') {
            $language = 'vi';
        } else if ($module_name == 'en') {
            $language = 'en';
        } else if ($module_name == 'cn') {
            $language = 'cn';
        }        
        $mapper=new Admin_Model_NewsMapper();
        $item=$mapper->getNoiDung();
        $this->view->lienHe=$item["news_$language"];
    }


}

