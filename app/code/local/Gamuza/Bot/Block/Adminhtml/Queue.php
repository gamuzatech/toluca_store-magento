<?php
/**
 * @package     Gamuza_Bot
 * @copyright   Copyright (c) 2020 Gamuza Technologies (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 */

class Gamuza_Bot_Block_Adminhtml_Queue extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct ()
	{
	    $this->_blockGroup = 'bot';
	    $this->_controller = 'adminhtml_queue';

	    $this->_headerText = Mage::helper ('bot')->__('Queue Manager');

	    parent::__construct();

        $this->_removeButton ('add');
	}
}

