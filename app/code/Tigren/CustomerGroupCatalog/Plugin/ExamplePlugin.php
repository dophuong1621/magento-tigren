<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Plugin;

use Tigren\CustomerGroupCatalog\Controller\Index\Example;

/**
 * Class ExamplePlugin
 * @package Tigren\CustomerGroupCatalog\Plugin
 */
class ExamplePlugin
{

    /**
     * @param Example $subject
     * @param $title
     * @return string[]
     */
    public function beforeSetTitle(Example $subject, $title)
    {
        $title = $title . " to ";
        echo __METHOD__ . "</br>";

        return [$title];
    }

    /**
     * @param Example $subject
     * @param $result
     * @return string
     */
    public function afterGetTitle(Example $subject, $result)
    {
        echo __METHOD__ . "</br>";

        return '<h1>' . $result . 'Mageplaza.com' . '</h1>';
    }

    /**
     * @param Example $subject
     * @param callable $proceed
     * @return mixed
     */
    public function aroundGetTitle(Example $subject, callable $proceed)
    {
        echo __METHOD__ . " - Before proceed() </br>";
        $result = $proceed();
        echo __METHOD__ . " - After proceed() </br>";

        return $result;
    }
}
