<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\Testimonial\Block\Testimonial;

use Exception;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;

/**
 * Class ListTestimonial
 * @package Tigren\Testimonial\Block\Testimonial
 */
class ListTestimonial extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $_testimonial;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Context $context
     * @param CollectionFactory $testimonial
     * @param array $data
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        CollectionFactory $testimonial,
        array $data = [],
        LoggerInterface   $logger,
    ) {
        $this->_testimonial = $testimonial;
        $this->logger = $logger;
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * @return AbstractDb|AbstractCollection
     */
    protected function _getTestimonialCollection()
    {
        try {
            $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
            $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;
            $collection = $this->_testimonial->create();
            $collection->setPageSize($pageSize);
            $collection->setCurPage($page);
            return $collection;
        } catch (Exception $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());
        }
    }

    /**
     * @return AbstractCollection|AbstractDb
     */
    public function getLoadedTestimonialCollection()
    {
        return $this->_getTestimonialCollection();
    }

    /**
     * @return $this|ListTestimonial
     * @throws LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->_getTestimonialCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->_getTestimonialCollection()
                );
            $this->setChild('pager', $pager);
            $this->_getTestimonialCollection()->load();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
