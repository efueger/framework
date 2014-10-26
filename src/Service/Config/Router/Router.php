<?php

namespace Framework\Service\Config\Router;

use Framework\Service\Config\Base;

class Router
    implements RouterService
{
    /**
     *
     */
    use Base;

    /**
     * @param $definition
     */
    public function __construct($definition)
    {
        $this->config = [
            self::NAME => self::ROUTER,
            self::ARGS => [$definition]
        ];
    }
}
