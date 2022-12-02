<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\CustomerGroup;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Index
 * @package Tigren\CustomerGroupCatalog\Controller\CustomerGroup
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param Redirect $resultRedirectFactory
     */
    public function __construct(
        Context              $context,
        PageFactory          $pageFactory,
        ScopeConfigInterface $scopeConfig,
        Redirect             $resultRedirectFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->scopeConfig = $scopeConfig;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $isEnableModule = $this->isEnableModule();
        if ($isEnableModule) {
            return $this->_pageFactory->create();
        }
        return $this->_redirect('/');
    }

    /**
     * @return mixed
     */
    public function isEnableModule()
    {
        return $this->scopeConfig->getValue('rule/general/enable', ScopeInterface::SCOPE_STORE);
    }
}
