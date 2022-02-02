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

class Gamuza_Basic_Block_Adminhtml_Catalog_Category_Tree
    extends Mage_Adminhtml_Block_Catalog_Category_Tree
{
    public function __construct()
    {
        parent::__construct();

        $this->_withProductCount = true;
    }

    protected function _prepareLayout ()
    {
        $result = parent::_prepareLayout ();

        $this->unsetChild ('store_switcher');

        return $result;
    }

    public function canAddRootCategory ()
    {
        return false;
    }

    public function canAddSubCategory()
    {
        $category = $this->getCategory();

        if ($category && $category->getId() && $category->getLevel() != 1)
        {
            return false;
        }

        return parent::canAddSubCategory();
    }
}
