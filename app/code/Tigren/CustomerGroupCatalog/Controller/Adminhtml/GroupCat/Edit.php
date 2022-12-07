<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Tigren\CustomerGroupCatalog\Model\GroupCat;

/**
 * Class Edit
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat
 */
class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var GroupCat
     */
    protected $rule;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param GroupCat $rule
     */
    public function __construct(Context $context, PageFactory $pageFactory, GroupCat $rule)
    {
        $this->_pageFactory = $pageFactory;
        $this->rule = $rule;
        parent::__construct($context);
    }

    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        $ruleId = $this->getRequest()->getParam('id');
        $rule = $this->rule->load($ruleId);
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()
            ->prepend(__('Edit Rule: ' . $rule->getName()));

        return $resultPage;
    }
}
