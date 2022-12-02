<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Quote
 * @package Tigren\AdvancedCheckout\Model\ResourceModel
 */
class Quote extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('quote_item', 'item_id');
    }
}
