<?php
/**
 * Core
 *
 * This file is part of Core.
 *
 * Core is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Core is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Core.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category    Core
 * @package     Core_Controller
 * @copyright   Copyright 2008-2012 Core
 * @license     GNU Public License V3.0
 */

/**
 *
 * @category    Core
 * @package     Core_Controller
 * @author      Core Core Team <core@onegatecommerce.com>
 * @abstract
 */
abstract class Core_Controller_Action extends Zend_Controller_Action
{
        /**
         * 
         * @var string
         */
        public $language;
        /**
	 * 
	 * @var integer
	 */
	public $page;	
	/**
	 *
	 * @var integer
	 */
	public $limit;
	/**
	 *
	 * @var integer
	 */
	public $start;
	/**
	 *
	 * @var integer
	 */
	public $order;
    /**
     *  Main init
     */
    public function init()
    {
        parent::init();
        


        
        
        $row = Core::single('Core/Action')
        				->select(array('page_title','page_subtitle'))
        				->where('module_name = ?',$this->_request->getModuleName(),'STRING')
        				->where('controller_name = ?',$this->_request->getControllerName(),'STRING')
        				->where('action_name = ?',$this->_request->getActionName(),'STRING')
        				->fetchRow()
        				
        ;        
        if(null!==$row){
        	$this->view->pageTitle = $row->page_title;
        	$this->view->pageSubTitle = $row->page_subtitle;
        	$this->view->headTitle($this->view->pageTitle.Core::config('site/info/name'),true);
        }        
        $this->view->headMeta()->appendName('author', 'Trần Công Tuệ email:chanhduypq@gmail.com');
        $this->view->headMeta()->appendName('copyright', 'Công ty TNHH VietAgar  website: http://vietagar.com.vn');
        $this->view->headMeta()->appendName('description', 'Chúng tôi không ngừng nổ lực phát triển website');
        $this->view->headMeta()->appendName('keywords', Core::config('site/info/keywords').',Trần Công Tuệ, chanhduypq@gmail.com');
        
        $this->initPaginator();
        
    }
    public function initPaginator(){
    	$this->page = $this->_getParam('page', 1);
    	$this->limit = $this->_getParam('limit', Core::config('core/page/limit'));
    	$this->start  = $this->_getParam('start', 0);
    	$this->order  = $this->_getParam('filter_order', 'id') . ' ' . $this->_getParam('filter_order_Dir', 'DESC');  	
    	
    }
    /**
     * thumnail ảnh
     */
    public function echo_js_css_for_thumnail() {
        ?>
        <link href="<?php echo APPLICATION_URL; ?>/css/thumnail/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="<?php echo APPLICATION_URL; ?>/js/thumnail/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="<?php echo APPLICATION_URL; ?>/js/thumnail/initPrettyPhoto.js"></script>               
        

        <?php
    }

    /**
     * HTTP_REFERER is not always present in _SERVER[]
     *
     * @return string
     */
    protected function _getBackUrl()
    {
        if (!$back = $this->getRequest()->getServer('HTTP_REFERER')) {
            $back = $this->view->href();
        }
        return $back;
    }

    /**
     * Write a snapshot to session
     *
     * @param string $snapshot
     * @return void
     */
    protected function _setSnapshot($snapshot)
    {
        Core::session()->snapshot = $snapshot;
    }

    /**
     * Retrieve snapshot from session
     *
     * @return string
     */
    protected function _getSnapshot()
    {
        $snapshot = Core::session()->snapshot;
        unset(Core::session()->snapshot);
        return $snapshot;
    }

    /**
     * @return bool
     */
    protected function _hasSnapshot()
    {
        return isset(Core::session()->snapshot)
            && !empty(Core::session()->snapshot);
    }
}