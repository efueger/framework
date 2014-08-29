<?php

namespace Framework\Service\Config\Service;

use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\FactoryInterface;
use Framework\Service\Config\ConfigTrait;

class Service
    implements ConfigInterface, ServiceInterface, FactoryInterface
{
    /**
     *
     */
    use ConfigTrait;

    /**
     * @param string $name
     * @param array $args
     */
    public function __construct($name, array $args = [])
    {
        $this->config = [
            self::NAME => $name,
            self::ARGS => $args
        ];
    }
}
