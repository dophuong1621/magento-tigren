<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Post
 * @package Tigren\HelloWorld\Model
 */
class Post extends AbstractModel
{
    const Testimonial_ID = 'entity_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'testimonial';

    /**
     * @var string
     */
    protected $_eventObject = 'testimonial';

    /**
     * @var string
     */
    protected $_idFieldName = self::Testimonial_ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\Testimonial\Model\ResourceModel\Testimonial');
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [1 => __('Disabled'), 0 => __('Enabled')];
    }
}
