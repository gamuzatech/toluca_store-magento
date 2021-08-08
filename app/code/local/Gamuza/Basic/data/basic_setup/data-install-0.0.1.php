<?php
/**
 * @package     Gamuza_Basic
 * @copyright   Copyright (c) 2016 Gamuza Technologies (http://www.gamuza.com.br/)
 * @author      Eneias Ramos de Melo <eneias@gamuza.com.br>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA 02110-1301, USA.
 */

/**
 * See the AUTHORS file for a list of people on the Gamuza Team.
 * See the ChangeLog files for a list of changes.
 * These files are distributed with gamuza_basic-magento at http://github.com/gamuzatech/.
 */

/**
 * Catalog
 */
$installer = new Mage_Catalog_Model_Resource_Setup ('basic_setup');
$installer->startSetup ();

$installer->updateAttribute ('catalog_category', 'custom_use_parent_settings', 'default_value', '1');
$installer->updateAttribute ('catalog_category', 'is_anchor',                  'default_value', '1');
$installer->updateAttribute ('catalog_category', 'page_layout',                'default_value', 'two_columns_left');

$installer->updateAttribute ('catalog_product', 'sku',               'frontend_input', 'label');
$installer->updateAttribute ('catalog_product', 'short_description', 'frontend_input', 'text');
$installer->updateAttribute ('catalog_product', 'url_key',           'frontend_input', 'label');
$installer->updateAttribute ('catalog_product', 'tax_class_id',      'default_value',  '0');

$installer->endSetup();

/**
 * Customer
 */
$installer = new Mage_Customer_Model_Resource_Setup ('basic_setup');
$installer->startSetup ();

$installer->updateAttribute ('customer', 'middlename', 'is_visible', '0');

$installer->updateAttribute ('customer_address', 'middlename', 'is_visible',      '0');
$installer->updateAttribute ('customer_address', 'company',    'is_visible',      '0');
$installer->updateAttribute ('customer_address', 'street',     'multiline_count', '4');
$installer->updateAttribute ('customer_address', 'telephone',  'is_required',     '0');
$installer->updateAttribute ('customer_address', 'fax',        'is_required',     '1');

$installer->endSetup();
