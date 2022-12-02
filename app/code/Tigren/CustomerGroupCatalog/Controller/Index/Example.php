<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Controller\Index;

use Magento\Framework\App\Action\Action;

/**
 * Class Example
 * @package Tigren\CustomerGroupCatalog\Controller\Index
 */
class Example extends Action
{
    protected $title;

    /**
     * @return void
     */
    public function execute()
    {
        echo $this->setTitle('Welcome');
        echo $this->getTitle();
    }

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title)
    {
        return $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}
