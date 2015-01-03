<?php
/**
 *
 */

namespace Framework\Service\Config\Child;

use Framework\Service\Config\Configuration;

interface ChildService
    extends Configuration
{
    /**
     *
     */
    const PARENT = 'parent';

    /**
     * @return string
     */
    function parent();
}
