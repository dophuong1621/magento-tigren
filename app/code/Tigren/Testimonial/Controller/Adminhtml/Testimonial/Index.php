<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Tigren\Testimonial\Controller\Adminhtml\Testimonial
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Tigren_Testimonial::testimonial';

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
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tigren_Testimonial::testimonial');
        $resultPage->addBreadcrumb(__('Testimonial'), __('Testimonial'));
        $resultPage->addBreadcrumb(__('Manage Testimonial'), __('Manage Testimonial'));
        $resultPage->getConfig()->getTitle()->prepend(__('Testimonial'));

        return $resultPage;
    }
}
