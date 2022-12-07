<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Tigren\CustomerGroupCatalog\Model\GroupCat;

/**
 * Class AddNew
 * @package Tigren\CustomerGroupCatalog\Adminhtml\GroupCat
 */
class AddNew extends Action
{
    /**
     * @var GroupCat
     */
    protected $rule;

    /**
     * @param Context $context
     * @param GroupCat $rule
     */
    public function __construct(
        Context  $context,
        GroupCat $rule
    ) {
        parent::__construct($context);
        $this->rule = $rule;
    }

    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $ruleId = $this->getRequest()->getParam('id');
        $rule = $this->rule->load($ruleId);
        if ($rule->getId()) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Rule ' . $rule->getName()));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Group Catalog'));
        }
        return $resultPage;
    }
}
