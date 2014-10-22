<?php

namespace Framework\Service\Config\Child;

use Framework\Service\Config\Configuration;
use Framework\Service\Config\ServiceConfig;

class Child
    implements ChildService, Configuration
{
    /**
     *
     */
    use ChildConfig;
    use ServiceConfig;

    /**
     * @param string $name
     * @param string $parent
     */
    public function __construct($name, $parent)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => $parent
        ];
    }
}
