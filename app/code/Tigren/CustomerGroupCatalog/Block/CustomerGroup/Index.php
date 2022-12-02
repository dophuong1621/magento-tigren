<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Block\CustomerGroup;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCatHistory\CollectionFactory;

/**
 * Class Index
 * @package Tigren\CustomerGroupCatalog\Block\CustomerGroup
 */
class Index extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $_oderHistoryCollectionFactory;

    /**
     * @param Context $context
     * @param CollectionFactory $orderHistoryCollectionFactory
     */
    public function __construct(Context $context, CollectionFactory $orderHistoryCollectionFactory)
    {
        parent::__construct($context);
        $this->_oderHistoryCollectionFactory = $orderHistoryCollectionFactory;
    }

    /**
     * @return mixed
     */
    public function getProductCollection()
    {
        return $this->_oderHistoryCollectionFactory->create()
            ->addFieldToSelect('*')
            ->join(
                ['salesOrder' => 'sales_order'],
                'main_table.order_id = salesOrder.increment_id'
            )
            ->join(
                ['customer' => 'customer_entity'],
                'main_table.customer_id = customer.entity_id'
            )
            ->join(
                ['rule' => 'tigren_customer_group_catalog'],
                'main_table.rule_id = rule.rule_id'
            )
            ->join(
                ['product' => 'catalog_product_entity'],
                'main_table.product_id = product.entity_id'
            );
    }
}
