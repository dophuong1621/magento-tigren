<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class GroupCat
 * @package Tigren\CustomerGroupCatalog\Model
 */
class GroupCat extends AbstractModel
{
    const GROUPCAT_ID = 'rule_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'groupcat';

    /**
     * @var string
     */
    protected $_eventObject = 'groupcat';

    /**
     * @var string
     */
    protected $_idFieldName = self::GROUPCAT_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCat');
    }
}
