<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Block\Testimonial;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Tigren\Testimonial\Model\TestimonialFactory;

/**
 * Class Edit
 * @package Tigren\Testimonial\Block\Testimonial
 */
class Edit extends Template
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var TestimonialFactory
     */
    protected $_contactLoader;

    /**
     * @var
     */
    protected $_request;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Registry $coreRegistry
     * @param TestimonialFactory $contactLoader
     * @param array $data
     */
    public function __construct(
        Context            $context,
        PageFactory        $pageFactory,
        Registry           $coreRegistry,
        TestimonialFactory $contactLoader,
        array              $data = []
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_contactLoader = $contactLoader;
        return parent::__construct($context, $data);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }

    /**
     * @return array|mixed|null
     */
    public function getEditData()
    {
        $id = $this->_coreRegistry->registry('editId');
        $postData = $this->_contactLoader->create();
        $result = $postData->load($id);
        $result = $result->getData();
        return $result;
    }
}
