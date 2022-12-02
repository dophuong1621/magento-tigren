<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Controller\Adminhtml\Testimonial;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Tigren\Testimonial\Model\Testimonial;

/**
 * Class Delete
 * @package Tigren\Testimonial\Controller\Adminhtml\Testimonial
 */
class Delete extends Action
{
    /**
     * @var Testimonial
     */
    protected $_model;

    /**
     * @param Action\Context $context
     * @param Testimonial $model
     */
    public function __construct(
        Action\Context $context,
        Testimonial    $model
    )
    {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tigren_Testimonial::testimonial_delete');
    }


    /**
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Testimonial deleted'));
                return $resultRedirect->setPadeparth('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Testimonial does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}
