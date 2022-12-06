<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Get;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\GroupCat\CollectionFactory;

/**
 * Class DataRule
 * @package Tigren\CustomerGroupCatalog\Controller\Get
 */
class DataRule extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context           $context,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function execute()
    {
        $this->collectionFactory->create();
        $collection = $this->collectionFactory->create()
            ->addFieldToSelect(['*'])
            ->addFieldToFilter('active', 1);

        return $collection->getData();
    }

    /**
     * @param int $id
     * @return void
     */
    public function getRule(int $id)
    {
        var_dump($id);
    }
}
