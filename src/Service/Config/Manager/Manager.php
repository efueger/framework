<?php

namespace Framework\Service\Config\Manager;

use Framework\Service\Config\Child\ChildInterface;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\ConfigTrait;

class Manager
    implements ChildInterface, ConfigInterface, ManagerInterface
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
