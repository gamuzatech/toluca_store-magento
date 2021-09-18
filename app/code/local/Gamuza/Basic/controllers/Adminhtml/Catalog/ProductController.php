<?php
/**
 * @package     Gamuza_Basic
 * @copyright   Copyright (c) 2021 Gamuza Technologies. (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 */

require_once (Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Catalog' . DS . 'ProductController.php');

/**
 * Catalog product controller
 */
class Gamuza_Basic_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{
    public function massStockQtyAction()
    {
        $productIds = $this->getRequest()->getParam('product');
        $productQty = $this->getRequest()->getParam('stock_qty');

        if (!is_array($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else
        {
            if (!empty($productIds))
            {
                try
                {
                    $resource = Mage::getSingleton ('core/resource');
                    $write    = $resource->getConnection ('core_write');
                    $table    = $resource->getTableName ('catalog/product');

                    foreach ($productIds as $productId)
                    {
                        $product = Mage::getSingleton('catalog/product')->load($productId);

                        Mage::dispatchEvent('catalog_controller_product_stock_qty', array('product' => $product));

                        $stockItem = Mage::getModel ('catalogInventory/stock_item')->assignProduct ($product)
                            ->setStockId (Mage_CatalogInventory_Model_Stock::DEFAULT_STOCK_ID)
                            ->setQty ($productQty)
                            ->setIsInStock (1)
                            ->save ()
                        ;

                        $query = sprintf ("UPDATE {$table} SET updated_at = '%s' WHERE entity_id = %s LIMIT 1",
                            date ('Y-m-d H:i:s'), $product->getId ()
                        );

                        $write->query ($query);
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massStockStatusAction()
    {
        $productIds    = $this->getRequest()->getParam('product');
        $productStatus = $this->getRequest()->getParam('stock_status');

        if (!is_array($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else
        {
            if (!empty($productIds))
            {
                try
                {
                    $resource = Mage::getSingleton ('core/resource');
                    $write    = $resource->getConnection ('core_write');
                    $table    = $resource->getTableName ('catalog/product');

                    foreach ($productIds as $productId)
                    {
                        $product = Mage::getSingleton('catalog/product')->load($productId);

                        Mage::dispatchEvent('catalog_controller_product_stock_qty', array('product' => $product));

                        $stockItem = Mage::getModel ('catalogInventory/stock_item')->assignProduct ($product)
                            ->setStockId (Mage_CatalogInventory_Model_Stock::DEFAULT_STOCK_ID)
                            ->setIsInStock ($productStatus)
                            ->save ()
                        ;

                        $query = sprintf ("UPDATE {$table} SET updated_at = '%s' WHERE entity_id = %s LIMIT 1",
                            date ('Y-m-d H:i:s'), $product->getId ()
                        );

                        $write->query ($query);
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massPriceAction()
    {
        $productIds   = $this->getRequest()->getParam('product');
        $productPrice = $this->getRequest()->getParam('price');

        if (empty($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else if (is_array($productIds))
        {
            if (is_numeric ($productPrice))
            {
                try
                {
                    /*
                    foreach ($productIds as $productId)
                    {
                        $product = Mage::getSingleton('catalog/product')->load($productId);

                        Mage::dispatchEvent('catalog_controller_product_price', array('product' => $product));

                        $product->setPrice ($productPrice)->save ();
                    }
                    */
                    $attributesData = array(
                        'price' => $productPrice
                    );

                    $storeId = Mage_Core_Model_App::ADMIN_STORE_ID;

                    Mage::getSingleton ('catalog/product_action')
                        ->updateAttributes ($productIds, $attributesData, $storeId)
                    ;

                    Mage::dispatchEvent ('catalog_controller_product_mass_price', array (
                        'product_ids' => $productIds, 'price' => $productPrice
                    ));

                    $resource = Mage::getSingleton ('core/resource');
                    $write    = $resource->getConnection ('core_write');
                    $table    = $resource->getTableName ('catalog/product');

                    foreach ($productIds as $id)
                    {
                        $query = sprintf ("UPDATE {$table} SET updated_at = '%s' WHERE entity_id = %s LIMIT 1",
                            date ('Y-m-d H:i:s'), $id
                        );

                        $write->query ($query);
                    }

                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massSpecialPriceAction()
    {
        $productIds   = $this->getRequest()->getParam('product');
        $productPrice = $this->getRequest()->getParam('special_price');

        if (empty($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else if (is_array($productIds))
        {
            if (is_numeric ($productPrice))
            {
                $productPrice = floatval ($productPrice) > 0 ? $productPrice : NULL;

                try
                {
                    /*
                    foreach ($productIds as $productId)
                    {
                        $product = Mage::getSingleton('catalog/product')->load($productId);

                        Mage::dispatchEvent('catalog_controller_product_price', array('product' => $product));

                        $product->setSpecialPrice ($productPrice)->save ();
                    }
                    */
                    $attributesData = array(
                        'special_price' => $productPrice
                    );

                    $storeId = Mage_Core_Model_App::ADMIN_STORE_ID;

                    Mage::getSingleton ('catalog/product_action')
                        ->updateAttributes ($productIds, $attributesData, $storeId)
                    ;

                    Mage::dispatchEvent ('catalog_controller_product_mass_special_price', array (
                        'product_ids' => $productIds, 'special_price' => $productPrice
                    ));

                    $resource = Mage::getSingleton ('core/resource');
                    $write    = $resource->getConnection ('core_write');
                    $table    = $resource->getTableName ('catalog/product');

                    foreach ($productIds as $id)
                    {
                        $query = sprintf ("UPDATE {$table} SET updated_at = '%s' WHERE entity_id = %s LIMIT 1",
                            date ('Y-m-d H:i:s'), $id
                        );

                        $write->query ($query);
                    }

                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massWeightAction()
    {
        $productIds    = $this->getRequest()->getParam('product');
        $productWeight = $this->getRequest()->getParam('weight');

        if (empty($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else if (is_array($productIds))
        {
            if (is_numeric ($productWeight))
            {
                try
                {
                    /*
                    foreach ($productIds as $productId)
                    {
                        $product = Mage::getSingleton('catalog/product')->load($productId);

                        Mage::dispatchEvent('catalog_controller_product_price', array('product' => $product));

                        $product->setSpecialPrice ($productPrice)->save ();
                    }
                    */
                    $attributesData = array(
                        'weight' => $productWeight
                    );

                    $storeId = Mage_Core_Model_App::ADMIN_STORE_ID;

                    Mage::getSingleton ('catalog/product_action')
                        ->updateAttributes ($productIds, $attributesData, $storeId)
                    ;

                    Mage::dispatchEvent ('catalog_controller_product_mass_weight', array (
                        'product_ids' => $productIds, 'weight' => $productWeight
                    ));

                    $resource = Mage::getSingleton ('core/resource');
                    $write    = $resource->getConnection ('core_write');
                    $table    = $resource->getTableName ('catalog/product');

                    foreach ($productIds as $id)
                    {
                        $query = sprintf ("UPDATE {$table} SET updated_at = '%s' WHERE entity_id = %s LIMIT 1",
                            date ('Y-m-d H:i:s'), $id
                        );

                        $write->query ($query);
                    }

                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massVisibilityAction()
    {
        $productIds        = $this->getRequest()->getParam('product');
        $productVisibility = $this->getRequest()->getParam('visibility');

        if (empty($productIds))
        {
            $this->_getSession()->addError($this->__('Please select product(s).'));
        }
        else if (is_array($productIds))
        {
            if (is_numeric ($productVisibility))
            {
                try
                {
                    /*
                    foreach ($productIds as $productId)
                    {
                        $product = Mage::getSingleton('catalog/product')->load($productId);

                        Mage::dispatchEvent('catalog_controller_product_price', array('product' => $product));

                        $product->setSpecialPrice ($productPrice)->save ();
                    }
                    */
                    $attributesData = array(
                        'visibility' => $productVisibility
                    );

                    $storeId = Mage_Core_Model_App::ADMIN_STORE_ID;

                    Mage::getSingleton ('catalog/product_action')
                        ->updateAttributes ($productIds, $attributesData, $storeId)
                    ;

                    Mage::dispatchEvent ('catalog_controller_product_mass_visibility', array (
                        'product_ids' => $productIds, 'weight' => $productVisibility
                    ));

                    $resource = Mage::getSingleton ('core/resource');
                    $write    = $resource->getConnection ('core_write');
                    $table    = $resource->getTableName ('catalog/product');

                    foreach ($productIds as $id)
                    {
                        $query = sprintf ("UPDATE {$table} SET updated_at = '%s' WHERE entity_id = %s LIMIT 1",
                            date ('Y-m-d H:i:s'), $id
                        );

                        $write->query ($query);
                    }

                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) have been updated.', count($productIds))
                    );
                }
                catch (Exception $e)
                {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }

        $this->_redirect('*/*/index');
    }
}

