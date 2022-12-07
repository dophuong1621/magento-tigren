<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Tigren\CustomerGroupCatalog\Model\GroupCat;

/**
 * Class Save
 * @package Tigren\CustomerGroupCatalog\Controller\Adminhtml\GroupCat
 */
class Save extends Action
{
    /**
     * @var GroupCat
     */
    private $groupCatFactory;

    /**
     * @param Context $context
     * @param GroupCat $groupCatFactory
     */
    public function __construct(
        Context  $context,
        GroupCat $groupCatFactory,
    ) {
        parent::__construct($context);
        $this->groupCatFactory = $groupCatFactory;
    }

    /**
     * @return Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['rule_id']) ? $data['rule_id'] : null;
        $groupCatData = [
            'name' => $data['name'],
            'discount_amount' => $data['discount_amount'],
            'customer_group_ids' => implode(',', $data['customer_group_ids']),
            'store_ids' => implode(',', $data['store_ids']),
            'product_ids' => $data['product_ids'],
            'start_time' => $data['start_time'],
            'time_end' => $data['time_end'],
            'priority' => $data['priority'],
            'active' => $data['active'],
        ];
        $groupCatFactory = $this->groupCatFactory;
        if ($id) {
            $groupCatFactory->load($id);
        }
        try {
            $groupCatFactory->addData($groupCatData);
            $groupCatFactory->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        return $this->resultRedirectFactory->create()->setPath('groupcat/groupcat/index');
    }
}
