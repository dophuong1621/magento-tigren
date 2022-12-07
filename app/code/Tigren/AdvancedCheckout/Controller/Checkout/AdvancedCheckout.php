<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Checkout;

use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class AdvancedCheckout
 * @package Tigren\AdvancedCheckout\Controller\Checkout
 */
class AdvancedCheckout extends Action
{

    /**
     * @var Product
     */
    private $productModel;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Cart $cart
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param Product $productModel
     */
    public function __construct(
        Cart              $cart,
        Context           $context,
        JsonFactory       $resultJsonFactory,
        Product           $productModel,
    ) {
        parent::__construct($context);
        $this->cart = $cart;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->productModel = $productModel;
    }

    /**
     * @return Json
     */
    public function execute()
    {
        $response = [
            'result' => false,
        ];
        $allProduct = $this->cart->getQuote()->getAllVisibleItems();
        $idProduct = $this->getRequest()->getParam('product');
        $product = $this->productModel->load($idProduct);
        $attributeProduct = (bool)$product->getData("allow_multi_order");
        $skuProduct = $product->getSku();
        if ($attributeProduct === true) {
            foreach ($allProduct as $item) {
                if (isset($item)) {
                    if ($item->getSku() == $skuProduct) {
                        $data = [
                            'product_in_cart' => $skuProduct,
                        ];
                        $response = [
                            'result' => true,
                            'data' => $data,
                        ];
                    } else {
                        $response = [
                            'result' => false,
                        ];
                    }
                }
            }
        }
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }
}
