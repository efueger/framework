<?php

namespace Framework\Service\Config\Service;

use Framework\Service\Config\Configuration;
use Framework\Service\Config\ServiceConfig;

class Service
    implements Config, Configuration
{
    /**
     *
     */
    use ServiceConfig;

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
