<?php

namespace Framework\Service\Config\Manager;

use Framework\Service\Config\Child\Config;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\ConfigTrait;

class Manager
    implements Config, Configuration, ServiceManager
{
    /**
     *
     */
    use ChildTrait;
    use ConfigTrait;

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
