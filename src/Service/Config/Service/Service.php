<?php

namespace Framework\Service\Config\Service;

use Framework\Service\Config\ConfigInterface;
use Framework\Service\Config\ResolverInterface;
use Framework\Service\Config\ConfigTrait;

class Service
    implements ConfigInterface, ServiceInterface, ResolverInterface
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
            self::ARGS => $args,
            self::NAME => $name
        ];
    }
}
