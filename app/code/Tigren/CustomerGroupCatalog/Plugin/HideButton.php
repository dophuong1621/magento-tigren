<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Http\Context;

/**
 * Class HideButton
 * @package Tigren\CustomerGroupCatalog\Plugin
 */
class HideButton
{
    /**
     * @var Context
     */
    private $httpContext;

    /**
     * @param Context $httpContext
     */
    public function __construct(
        Context $httpContext,
    ) {
        $this->httpContext = $httpContext;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function afterIsSaleable(Product $product)
    {
        $isLoggedIn = $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if ($isLoggedIn) {
            return true;
        } else {
            return false;
        }
    }
}
