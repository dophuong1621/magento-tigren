<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class GroupCatHistory
 * @package Tigren\CustomerGroupCatalog\Model
 */
class GroupCatHistory extends AbstractModel
{
    const GROUPCATHISTORY_ID = 'entity_id';

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
    protected $_idFieldName = self::GROUPCATHISTORY_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCatHistory');
    }
}
