<?php
/**
 * @package     Gamuza_Basic
 * @copyright   Copyright (c) 2023 Gamuza Technologies (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 */

class Gamuza_Basic_Adminhtml_Order_ServiceController extends Mage_Adminhtml_Controller_Action
{
	protected function _isAllowed ()
	{
	    return Mage::getSingleton ('admin/session')->isAllowed ('sales/service');
	}

	protected function _initAction ()
	{
		$this->loadLayout ()->_setActiveMenu ('sales/service')
            ->_addBreadcrumb(
                Mage::helper ('basic')->__('Services Manager'),
                Mage::helper ('basic')->__('Services Manager')
            )
        ;

		return $this;
	}

	public function indexAction ()
	{
	    $this->_title ($this->__('Sales'));
	    $this->_title ($this->__('Services Manager'));

		$this->_initAction ();

		$this->renderLayout ();
	}
}

