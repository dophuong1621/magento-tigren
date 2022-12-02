<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class CustomerEntity
 * @package Tigren\AdvancedCheckout\Model
 */
class CustomerEntity extends AbstractModel
{
    const ENTITY_ID = 'entity_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'checkout';

    /**
     * @var string
     */
    protected $_eventObject = 'checkout';

    /**
     * @var string
     */
    protected $_idFieldName = self::ENTITY_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\AdvancedCheckout\Model\ResourceModel\CustomerEntity');
    }
}
