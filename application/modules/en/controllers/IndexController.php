<?php

class En_IndexController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $module_name = $this->_request->getModuleName();
        if ($module_name == 'default') {
            $language = 'vi';
        } else if ($module_name == 'en') {
            $language = 'en';
        } else if ($module_name == 'cn') {
            $language = 'cn';
        }
        $this->language=$language;
        $this->limit=5;
    }
    public function autocompleteAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $term = $this->_request->getParam('q', '');
        $max_rows = $this->_request->getParam('max_rows', 10);
        $mapper = new Default_Model_Index();
        $rows = $mapper->autoComplete($term,$this->language, $max_rows);
        echo Zend_Json::encode($rows);
    }

    public function indexAction() {
        
        $mapper = new Default_Model_Index();
        $rows = $mapper->getMatHangs();
        for($i=0;$i<count($rows);$i++){
            $temp=$mapper->getChildren($rows[$i]['id']);
            if(is_array($temp)&&count($temp)>0){
                $rows[$i]['has_children']=true;
            }
            else{
                $rows[$i]['has_children']=FALSE;
            }
        }
        $this->view->matHangs = $rows;
        $this->view->language=$this->language;
    }
    

    public function searchAction() {
        $search_text = $this->_request->getParam('search_text');
        $old_search_text = $this->_request->getParam('old_search_text', '');
        $this->view->search_text = $search_text;
        $limit = $this->_getParam('limit', $this->limit);
        $old_item_count_per_page = $this->_request->getParam('old_item_count_per_page', $this->limit);
        $page = $this->_getParam('page', 1);
        if ($limit != $old_item_count_per_page || $search_text != $old_search_text) {
            $page = 1;
        }
        $order = $this->_getParam('filter_order', 'id') . ' ' . $this->_getParam('filter_order_Dir', 'DESC');
        $start = (($page - 1) * $limit);
        $mapper = new Common_Model_TableMapper('Default/Index');
        $where = array();
        if(trim($search_text)==""){
            $where[] = array("false");
        }
        else{
            $where[] = array("ten_mat_hang_".$this->language." like '%$search_text%'");
        }
        
        $rows = $mapper->listItems($limit, $start, $where);
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Null($mapper->getCountItems()));
        $paginator->setDefaultScrollingStyle();
        $paginator->setItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        $this->view->params = $this->_getAllParams();
        $this->view->matHangs = $rows;
        $this->view->paginator = $paginator;
        $this->view->start = $start;
        $this->view->filter_order = $this->_getParam('filter_order');
        $this->view->filter_order_Dir = $this->_getParam('filter_order_Dir');
        $this->view->result = $this->_request->getParam('result', array());
        $this->view->language=$this->language;
        $this->view->limit=$this->limit;
        $this->view->total=$mapper->getCountItems();
       
    }

    public function detailAction() {        
        $id = $this->_request->getParam('id');
        $mapper = new Default_Model_Index();
        $rows = $mapper->getMatHangsNotOneId($id);
        $children=$mapper->getChildren($id);  
        $row=$mapper->getMatHang($id);
        $title=$row['title_'.$this->language];
        $loi_gioi_thieu=$row['loi_gioi_thieu_'.$this->language];
        $mo_ta=$row['mo_ta_'.$this->language];
        $this->view->matHangs = $rows;
        $this->view->children = $children;
        $this->view->language=$this->language;
        $this->view->title=$title;
        $this->view->loi_gioi_thieu=$loi_gioi_thieu;
        $this->view->mo_ta=$mo_ta;
    }
    public function detailnextAction() {        
        $id = $this->_request->getParam('id');        
        $mapper = new Default_Model_Index();
        $row=$mapper->getMatHang($id);
        $samp_type_rows=$mapper->getSameTypeMatHangs($id);
        $rows = $mapper->getMatHangsNotOneId($row['parent_id']);        
        for($i=0;$i<count($rows);$i++){
            $temp=$mapper->getChildren($rows[$i]['id']);
            if(is_array($temp)&&count($temp)>0){
                $rows[$i]['has_children']=true;
            }
            else{
                $rows[$i]['has_children']=FALSE;
            }
        }
        $this->view->matHangs = $rows;
        $this->view->row = $row;
        $this->view->language=$this->language;
        $this->view->samp_type_rows=$samp_type_rows;        
    }

    public function postDispatch() {
        parent::postDispatch();
        if ($this->getRequest()->getActionName() != 'autocomplete') {
            $this->echo_js_css_for_thumnail();
        }
        
    }

    public function viewdetailajaxAction() {
        $this->_helper->layout()->disableLayout();
        $id = $this->_request->getParam('id');
        $mapper = new Default_Model_Index();        
        $row=$mapper->getMatHang($id);
        $this->view->row = $row;
        $this->view->language=$this->language;
        
    }

}
