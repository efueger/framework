<?php

namespace Framework\Service\Config\Factory;

use Framework\Service\Config\Child\ChildService;
use Framework\Service\Config\Child\ChildConfig;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\ServiceConfig;

class Factory
    implements ChildService, Configuration, ServiceFactory
{
    /**
     *
     */
    use ChildConfig;
    use ServiceConfig;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->config = [
            self::NAME   => $name,
            self::PARENT => self::FACTORY
        ];
    }
}
