<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Controller\PlaceOrder;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Zend_Log_Exception;

/**
 * Class AdvancedCheckout
 * @package Tigren\AdvancedCheckout\Controller\PlaceOrder
 */
class PlaceOrder extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var CollectionFactory
     */
    private $salesOrderFactory;

    /**
     * @var Session
     */
    private $_customerSession;

    /**
     * @param Context $context
     * @param CollectionFactory $salesOrderFactory
     * @param Session $customerSession
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context           $context,
        CollectionFactory $salesOrderFactory,
        Session           $customerSession,
        JsonFactory       $resultJsonFactory,
    ) {
        parent::__construct($context);
        $this->salesOrderFactory = $salesOrderFactory;
        $this->_customerSession = $customerSession;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * @return Json
     * @throws Zend_Log_Exception
     */
    public function execute()
    {
        $email = $this->_customerSession->getCustomer()->getEmail();
        $collection = $this->salesOrderFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_email', $email)
            ->setOrder('entity_id', 'DESC');
        $order = $collection->setPageSize(1)->getFirstItem();
        $status = $order->getStatus();
        if ($status === 'complete') {
            $response = [
                'result' => true,
            ];
        } else {
            $response = [
                'result' => false,
            ];
        }
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }
}
