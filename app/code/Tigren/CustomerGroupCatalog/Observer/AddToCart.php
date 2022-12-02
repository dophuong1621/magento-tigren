<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Observer;

use Exception;
use Magento\Checkout\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;
use Psr\Log\LoggerInterface;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCat\CollectionFactory;

/**
 * Class AddToCart
 * @package Tigren\CustomerGroupCatalog\Observer
 */
class AddToCart implements ObserverInterface
{
    /**
     * @var Session
     */
    private $_checkoutSession;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var DateTimeFactory
     */
    private $dateTimeFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Session $checkoutSession
     * @param CollectionFactory $collectionFactory
     * @param DateTimeFactory $dateTimeFactory
     * @param LoggerInterface $logger
     */

    public function __construct(
        Session           $checkoutSession,
        CollectionFactory $collectionFactory,
        DateTimeFactory   $dateTimeFactory,
        LoggerInterface   $logger,
    )
    {
        $this->_checkoutSession = $checkoutSession;
        $this->collectionFactory = $collectionFactory;
        $this->dateTimeFactory = $dateTimeFactory;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $this->_checkoutSession->start();

            $product = $observer->getEvent()->getProduct();
            $quoteItem = $observer->getEvent()->getQuoteItem();

            $sku = $product->getSku();
            $priceProduct = $product->getPrice();

            $date = $this->dateTimeFactory->create();
            $formatDate = $date->gmtDate('Y-m-d H:i:s');
            $dateCurrent = date("Y-m-d H:i:s", strtotime($formatDate) + (60 * 420));

            $collection = $this->collectionFactory->create()
                ->addFieldToSelect('*')
                ->addFieldToFilter('active', 1)
                ->addFieldToFilter('product_ids', $sku)
                ->addFieldToFilter('start_time', ['lteq' => $dateCurrent])
                ->addFieldToFilter('time_end', ['gteq' => $dateCurrent])
                ->setOrder('priority', 'ASC');

            $rule = $collection->setPageSize(1)->getFirstItem();

            if ($rule->getId() > 0) {
                $this->_checkoutSession->setRuleId($rule->getId());
                $this->_checkoutSession->setProductId($product->getId());
                $discount = $rule->getDiscountAmount();
                $price = $priceProduct - ($priceProduct * $discount / 100);
                $quoteItem->setCustomPrice($price);
                $quoteItem->setOriginalCustomPrice($price);
                $quoteItem->getProduct()->setIsSuperMode(true);
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
        }
    }
}
