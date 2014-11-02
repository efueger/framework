<?php

namespace Framework\Service\Config\Service;

use Framework\Service\Config\Base;
use Framework\Service\Resolver\Resolvable;

class Service
    implements Config, Resolvable
{
    /**
     *
     */
    use Base;

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
