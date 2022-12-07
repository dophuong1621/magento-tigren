<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Block\CustomerGroup;

use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCatHistory\Collection;
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
     * @var Product
     */
    protected $product;

    /**
     * @param Context $context
     * @param CollectionFactory $orderHistoryCollectionFactory
     * @param Product $product
     */
    public function __construct(
        Context $context,
        CollectionFactory $orderHistoryCollectionFactory,
        Product $product,
    ) {
        parent::__construct($context);
        $this->_oderHistoryCollectionFactory = $orderHistoryCollectionFactory;
        $this->product = $product;
    }

    /**
     * @return Collection
     */
    public function getProductCollection()
    {
        return $this->_oderHistoryCollectionFactory->create()
            ->addFieldToSelect('*');
    }
}
