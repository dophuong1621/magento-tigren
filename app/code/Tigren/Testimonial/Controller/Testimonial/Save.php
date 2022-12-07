<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Controller\Testimonial;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Tigren\Testimonial\Model\TestimonialFactory;

/**
 * Class Save
 * @package Tigren\Testimonial\Controller\Testimonial
 */
class Save extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @var TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param TestimonialFactory $testimonialFactory
     * @param Session $customerSession
     */
    public function __construct(
        Context            $context,
        PageFactory        $pageFactory,
        TestimonialFactory $testimonialFactory,
        Session $customerSession,
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;
        $this->customerSession = $customerSession;
        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface
     */
    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            $newData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'company' => $data['company'],
                'rating' => $data['rating'],
                'status' => $data['status']
            ];

            if (!empty($newData)) {
                $attributeTestimonial = $this->customerSession->getCustomer()->getData('is_created_testimonialis');
                if ($attributeTestimonial == 0) {
                    $attribute = $this->customerSession->getCustomer()->setData('is_created_testimonialis', 1);
                    $attribute->save();
                }
                $model = $this->_testimonialFactory->create();
                $model->addData($newData);
                $model->save();
                $this->messageManager->addSuccessMessage(__("Data Created Successfully."));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $this->_redirect('testimonial/testimonial/index');
    }
}
