<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Model\Source\Testimonial;

use Magento\Framework\Data\OptionSourceInterface;
use Tigren\Testimonial\Model\Testimonial;

/**
 * Class Status
 * @package Tigren\Testimonial\Model\Source\Testimonial
 */
class Status implements OptionSourceInterface
{
    /**
     * @var Testimonial
     */
    protected $_testimonial;

    /**
     * @param Testimonial $_testimonial
     */
    public function __construct(Testimonial $_testimonial)
    {
        $this->_testimonial = $_testimonial;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->_testimonial->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
