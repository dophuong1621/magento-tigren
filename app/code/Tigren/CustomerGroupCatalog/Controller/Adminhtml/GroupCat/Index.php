<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Tigren_CustomerGroupCatalog::groupcat';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tigren_CustomerGroupCatalog::groupcat');
        $resultPage->addBreadcrumb(__('Group Catalog'), __('Group Catalog'));
        $resultPage->addBreadcrumb(__('Manage Group Catalog'), __('Manage Group Catalog'));
        $resultPage->getConfig()->getTitle()->prepend(__('Group Catalog'));

        return $resultPage;
    }
}
