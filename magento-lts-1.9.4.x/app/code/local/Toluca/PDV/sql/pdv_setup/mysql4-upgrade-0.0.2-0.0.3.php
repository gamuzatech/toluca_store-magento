<?php
/**
 * @package     Toluca_PDV
 * @copyright   Copyright (c) 2022 Gamuza Technologies (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 */

$installer = new Mage_Sales_Model_Resource_Setup ('pdv_setup');
$installer->startSetup ();

/**
 * Quote & Order
 */
$entities = array(
    'quote',
    'order',
);

$options = array(
    'type'     => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
    'usigned'  => true,
    'nullable' => false,
    'visible'  => true,
    'required' => false,
);

foreach ($entities as $entity)
{
    $installer->addAttribute ($entity, Toluca_PDV_Helper_Data::ORDER_ATTRIBUTE_IS_PDV, $options);
    $installer->addAttribute ($entity, Toluca_PDV_Helper_Data::ORDER_ATTRIBUTE_IS_SAT, $options);
    $installer->addAttribute ($entity, Toluca_PDV_Helper_Data::ORDER_ATTRIBUTE_IS_SERVICE, $options);
}

$options = array(
    'type'     => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length'   => 11,
    'usigned'  => true,
    'nullable' => false,
    'visible'  => true,
    'required' => false,
);

foreach ($entities as $entity)
{
    $installer->addAttribute ($entity, Toluca_PDV_Helper_Data::ORDER_ATTRIBUTE_PDV_CASHIER_ID, $options);
    $installer->addAttribute ($entity, Toluca_PDV_Helper_Data::ORDER_ATTRIBUTE_PDV_OPERATOR_ID, $options);
    $installer->addAttribute ($entity, Toluca_PDV_Helper_Data::ORDER_ATTRIBUTE_PDV_CUSTOMER_ID, $options);
}

$installer->endSetup ();

