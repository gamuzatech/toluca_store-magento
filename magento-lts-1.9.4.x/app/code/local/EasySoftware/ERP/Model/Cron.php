<?php
/**
 * @package     EasySoftware_ERP
 * @copyright   Copyright (c) 2022 Gamuza Technologies (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 */

class EasySoftware_ERP_Model_Cron
{
    public function runBrand ()
    {
        Mage::getModel ('erp/cron_brand')->run ();
    }

    public function runGroup ()
    {
        Mage::getModel ('erp/cron_group')->run ();
    }

    public function runProduct ()
    {
        Mage::getModel ('erp/cron_product')->run ();
    }

    public function runCustomer ()
    {
        Mage::getModel ('erp/cron_customer')->run ();
    }

    public function runOrder ()
    {
        Mage::getModel ('erp/cron_order')->run ();
    }

    public function runOrderStatus ()
    {
        Mage::getModel ('erp/cron_order_status')->run ();
    }
}
