<?php

namespace Framework\Service\Config\Service;

use Framework\Service\Config\Configuration;
use Framework\Service\Config\ConfigTrait;

class Service
    implements Config, Configuration
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
