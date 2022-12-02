<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Testimonial
 * @package Tigren\Testimonial\Model\ResourceModel
 */
class Testimonial extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tigren_testimonial', 'entity_id');
    }
}
