<?php

namespace Framework\Service\Config\Service;

use Framework\Service\Config\Base;

class Service
    implements Config
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
