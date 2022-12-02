<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Model\ResourceModel\SalesOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\AdvancedCheckout\Model\SalesOrder;

/**
 * Class Collection
 * @package Tigren\AdvancedCheckout\Model\ResourceModel\Quote
 */
class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = SalesOrder::SALESID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\AdvancedCheckout\Model\SalesOrder', 'Tigren\AdvancedCheckout\Model\ResourceModel\SalesOrder');
    }

}
