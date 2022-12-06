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
use Tigren\AdvancedCheckout\Model\ResourceModel\CatalogProductEntityInt\CollectionFactory as CatProductFactory;
use Tigren\AdvancedCheckout\Model\ResourceModel\Quote\CollectionFactory;

/**
 * Class AdvancedCheckout
 * @package Tigren\AdvancedCheckout\Controller\Checkout
 */
class AdvancedCheckout extends Action
{
    /**
     * @var CollectionFactory
     */
    private $quoteItemFactory;

    /**
     * @var Product
     */
    private $productModel;

    /**
     * @var CatProductFactory
     */
    private $catProductFactory;

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
     * @param CollectionFactory $quoteItemFactory
     * @param CatProductFactory $catProductFactory
     * @param JsonFactory $resultJsonFactory
     * @param Product $productModel
     */
    public function __construct(
        Cart              $cart,
        Context           $context,
        CollectionFactory $quoteItemFactory,
        CatProductFactory $catProductFactory,
        JsonFactory       $resultJsonFactory,
        Product           $productModel,
    )
    {
        parent::__construct($context);
        $this->quoteItemFactory = $quoteItemFactory;
        $this->cart = $cart;
        $this->catProductFactory = $catProductFactory;
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
        $skuProduct = $product->getSku();


        $attributeProduct = $product->getData("allow_multi_order");

        if ($attributeProduct == 1) {
            foreach ($allProduct as $item) {
                if ($item->getSku() == $skuProduct) {
//                    $paramQty = $this->getRequest()->getParam('qty');
                    if ($item->getQty() > 1) {
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
