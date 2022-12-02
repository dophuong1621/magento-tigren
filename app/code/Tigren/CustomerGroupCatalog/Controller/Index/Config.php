<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Tigren\CustomerGroupCatalog\Helper\Data;

/**
 * Class Config
 * @package Tigren\CustomerGroupCatalog\Controller\Index
 */
class Config extends Action
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @param Context $context
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        Data    $helperData
    ) {
        $this->helperData = $helperData;
        return parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');
        exit();
    }
}
