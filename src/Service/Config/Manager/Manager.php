<?php

namespace Framework\Service\Config\Manager;

use Framework\Service\Config\Child\ChildService;
use Framework\Service\Config\Child\ChildConfig;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\ServiceConfig;

class Manager
    implements ChildService, Configuration, ServiceManager
{
    /**
     *
     */
    use ChildConfig;
    use ServiceConfig;

    /**
     * @param string $name
     * @param array $calls
     */
    public function __construct($name, array $calls = [])
    {
        $this->config = [
            self::CALLS  => $calls,
            self::MERGE  => true,
            self::NAME   => $name,
            self::PARENT => self::MANAGER
        ];
    }
}
