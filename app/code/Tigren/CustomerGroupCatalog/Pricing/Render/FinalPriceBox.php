<?php

namespace Tigren\CustomerGroupCatalog\Pricing\Render;

use Magento\Customer\Model\Context;
use Magento\Framework\App\ObjectManager;

/**
 * Class FinalPriceBox
 * @package Tigren\CustomerGroupCatalog\Pricing\Render
 */
class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    /**
     * @param $html
     * @return string
     */
    protected function wrapResult($html)
    {
        $objectManager = ObjectManager::getInstance();
        $httpContext = $objectManager->get('Magento\Framework\App\Http\Context');
        $isLoggedIn = $httpContext->getValue(Context::CONTEXT_AUTH);
        if ($isLoggedIn) {
            return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
                'data-role="priceBox" ' .
                'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
                '>' . $html . '</div>';
        } else {
            $wording = 'Please Login To See Price';
            return '<div class="" ' .
                'data-role="priceBox" ' .
                'data-product-id="' . $this->getSaleableItem()->getId() . '"' .
                '>' . $wording . '</div>';
        }
    }
}
