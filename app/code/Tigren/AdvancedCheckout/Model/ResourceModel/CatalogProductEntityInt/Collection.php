<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Model\ResourceModel\CatalogProductEntityInt;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\AdvancedCheckout\Model\CatalogProductEntityInt;

/**
 * Class Collection
 * @package Tigren\AdvancedCheckout\Model\ResourceModel\CatalogProductEntityInt
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = CatalogProductEntityInt::VALUE_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\AdvancedCheckout\Model\CatalogProductEntityInt', 'Tigren\AdvancedCheckout\Model\ResourceModel\CatalogProductEntityInt');
    }

}
