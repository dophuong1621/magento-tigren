<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Controller\Testimonial;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResponseInterface;
use Tigren\Testimonial\Model\TestimonialFactory;

/**
 * Class Delete
 * @package Tigren\Testimonial\Controller\Testimonial
 */
class Delete extends Action
{
    /**
     * @var Http
     */
    protected $_request;

    /**
     * @var TestimonialFactory
     */
    private $_tesimonialFactory;

    /**
     * @param Context $context
     * @param Http $request
     * @param TestimonialFactory $_testimonialFactory
     */
    public function __construct(
        Context            $context,
        Http               $request,
        TestimonialFactory $_testimonialFactory
    ) {
        $this->_request = $request;
        $this->_tesimonialFactory = $_testimonialFactory;
        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface
     * @throws Exception
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');
        $testimonial = $this->_tesimonialFactory->create()->load($id);
        $testimonial->delete();
        return $this->_redirect('testimonial/testimonial/index');
    }
}
