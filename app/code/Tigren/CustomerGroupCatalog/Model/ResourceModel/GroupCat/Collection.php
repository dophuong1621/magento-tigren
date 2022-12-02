<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCat;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\CustomerGroupCatalog\Model\GroupCat;

/**
 * Class Collection
 * @package Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCat
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = GroupCat::GROUPCAT_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\CustomerGroupCatalog\Model\GroupCat', 'Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCat');
    }
}
