<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\Checkout;

use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Checkout\Model\Sidebar;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Api\CartRepositoryInterface;

/**
 * Class ClearCart
 * @package Tigren\AdvancedCheckout\Controller\Checkout
 */
class ClearCart extends Action
{
    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Sidebar
     */
    protected $sidebar;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var CartRepositoryInterface
     */
    protected $_cartRepository;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param CheckoutSession $checkoutSession
     * @param Cart $cart
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param RequestInterface $request
     * @param Sidebar $sidebar
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        CheckoutSession         $checkoutSession,
        Cart                    $cart,
        Context                 $context,
        JsonFactory             $resultJsonFactory,
        RequestInterface        $request,
        Sidebar                 $sidebar,
        CartRepositoryInterface $cartRepository,
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->_cartRepository = $cartRepository;
        $this->cart = $cart;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->sidebar = $sidebar;
        parent::__construct($context);
    }

    /**
     * @return Json
     */
    public function execute()
    {
        $this->cart->truncate()->save();
        $response = [
            'result' => true,
        ];
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }
}
