<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\AdvancedCheckout\Observer;

use Exception;
use Magento\Checkout\Model\Session;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session as cumtomerSession;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * Class GetQuote
 * @package Tigren\CustomerGroupCatalog\Observer
 */
class CreateNewCustomerAccount implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CustomerFactory
     */
    protected $customerEntityFactory;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var cumtomerSession
     */
    private $customerSession;

    /**
     * @param cumtomerSession $customerSession
     * @param Session $session
     * @param LoggerInterface $logger
     * @param CustomerFactory $customerEntityFactory
     */
    public function __construct(
        cumtomerSession $customerSession,
        Session $session,
        LoggerInterface $logger,
        CustomerFactory $customerEntityFactory,
    ) {
        $this->customerSession = $customerSession;
        $this->session = $session;
        $this->logger = $logger;
        $this->customerEntityFactory = $customerEntityFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            if (!($this->customerSession->isLoggedIn())) {
                $customerEmail = $this->session->getLastRealOrder()->getCustomerEmail();
                $firstName = $this->session->getLastRealOrder()->getCustomerFirstname();
                $lastName = $this->session->getLastRealOrder()->getCustomerLastname();
                $customer = [
                    'email' => $customerEmail,
                    'password_hash' => md5('succcess'),
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                ];
                $createCustomerAcount = $this->customerEntityFactory->create();
                $createCustomerAcount->addData($customer);
                $createCustomerAcount->save();
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
        }
    }
}
