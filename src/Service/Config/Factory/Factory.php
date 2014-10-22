<?php

namespace Framework\Service\Config\Factory;

use Framework\Service\Config\Child\Config;
use Framework\Service\Config\Child\ChildTrait;
use Framework\Service\Config\Configuration;
use Framework\Service\Config\ConfigTrait;

class Factory
    implements Config, Configuration, ServiceFactory
{
    /**
     *
     */
    use ChildTrait;
    use ConfigTrait;

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
