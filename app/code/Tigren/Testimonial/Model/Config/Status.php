<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Model\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Status
 * @package Tigren\HelloWorld\Model\Config
 */
class Status implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Pending')],
            ['value' => 2, 'label' => __('Published')]
        ];
    }
}
